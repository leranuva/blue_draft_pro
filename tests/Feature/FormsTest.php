<?php

namespace Tests\Feature;

use App\Jobs\AddLeadToEmailSequence;
use App\Models\LeadMagnetSubscriber;
use App\Models\Quote;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FormsTest extends TestCase
{
    use RefreshDatabase;

    public function test_quote_complete_updates_quote_and_redirects(): void
    {
        Mail::fake();
        Queue::fake();
        Storage::fake('quote_attachments');
        Storage::fake('public');

        $draft = $this->postJson('/quote/partial', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'service' => 'residential',
        ])->assertOk();
        $quote = Quote::findOrFail($draft->json('quote_id'));

        $response = $this->post('/quote/complete', [
            'quote_id' => $quote->id,
            'phone' => '5551234567',
            'address' => '123 Test St',
            'budget' => '50k-100k',
            'message' => 'Test message',
            'photos' => [UploadedFile::fake()->image('kitchen.jpg')],
            'g-recaptcha-response' => '',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $quote->refresh();
        $this->assertFalse($quote->is_partial);
        $this->assertSame('5551234567', $quote->phone);
        $this->assertSame('123 Test St', $quote->address);
        $path = $quote->attachments()->sole()->file_path;
        Storage::disk('quote_attachments')->assertExists($path);
        Storage::disk('public')->assertMissing($path);

        Queue::assertPushed(AddLeadToEmailSequence::class);

        $this->post('/quote/complete', [
            'quote_id' => $quote->id,
            'message' => 'Duplicate submission',
        ])->assertSessionHas('success');
        $this->assertSame('Test message', $quote->fresh()->message);
        Queue::assertPushed(AddLeadToEmailSequence::class, 1);
    }

    public function test_quote_complete_fails_with_invalid_quote_id(): void
    {
        $response = $this->post('/quote/complete', [
            'quote_id' => 99999,
            'g-recaptcha-response' => '',
        ]);

        $response->assertSessionHasErrors('quote_id');
    }

    public function test_quote_complete_rejects_another_sessions_draft(): void
    {
        $quote = Quote::create([
            'client_name' => 'Test',
            'email' => 'test@example.com',
            'service_type' => 'residential',
            'is_partial' => true,
            'step' => 1,
            'status' => 'pending',
            'stage' => Quote::STAGE_NEW,
        ]);

        $response = $this->post('/quote/complete', [
            'quote_id' => $quote->id,
            'g-recaptcha-response' => '',
        ]);

        $response->assertSessionHasErrors('quote_id');
        $this->assertTrue($quote->fresh()->is_partial);
    }

    public function test_calculator_values_are_recomputed_from_validated_inputs(): void
    {
        $response = $this->postJson('/quote/partial', [
            'name' => 'Test',
            'email' => 'calculator@example.com',
            'service' => 'renovation',
            'from_calculator' => true,
            'calculator_sqft' => 200,
            'calculator_type' => 'kitchen',
            'calculator_borough' => 'nj',
            'calculator_finish_level' => 'standard',
            'estimated_value' => 1,
            'calculator_budget_min' => 1,
            'calculator_budget_max' => 1,
            'calculation_hash' => 'untrusted',
        ])->assertOk();

        $quote = Quote::findOrFail($response->json('quote_id'));
        $this->assertEquals(50000, $quote->estimated_value);
        $this->assertEquals(30000, $quote->calculator_budget_min);
        $this->assertEquals(70000, $quote->calculator_budget_max);
        $this->assertNotSame('untrusted', $quote->calculation_hash);
    }

    public function test_legacy_attachment_migration_is_idempotent(): void
    {
        Storage::fake('quote_attachments');
        Storage::fake('public');
        $quote = Quote::factory()->create();
        $path = "quotes/{$quote->id}/legacy.jpg";
        $quote->attachments()->create([
            'file_path' => $path,
            'file_type' => 'image/jpeg',
            'original_name' => 'legacy.jpg',
            'file_size' => 4,
        ]);
        Storage::disk('public')->put($path, 'data');
        Storage::disk('public')->put('quotes/999/orphan.jpg', 'orphan');

        $this->artisan('quotes:privatize-attachments')->assertSuccessful();
        $this->artisan('quotes:privatize-attachments')->assertSuccessful();

        Storage::disk('public')->assertMissing([$path, 'quotes/999/orphan.jpg']);
        $this->assertSame('data', Storage::disk('quote_attachments')->get($path));
        $this->assertSame('orphan', Storage::disk('quote_attachments')->get('quotes/999/orphan.jpg'));
    }

    public function test_partial_quote_has_a_rate_limit(): void
    {
        $data = ['name' => 'Test', 'email' => 'test@example.com', 'service' => 'residential'];

        for ($i = 0; $i < 10; $i++) {
            $this->postJson('/quote/partial', $data)->assertOk();
        }

        $this->postJson('/quote/partial', $data)->assertTooManyRequests();
        $this->assertDatabaseCount('quotes', 10);
    }

    public function test_lead_magnet_submit_creates_subscriber_and_redirects(): void
    {
        Queue::fake();

        $response = $this->post('/free-renovation-guide', [
            'email' => 'new@example.com',
            'name' => 'New User',
        ]);

        $response->assertRedirect(route('lead-magnet.guide'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('lead_magnet_subscribers', [
            'email' => 'new@example.com',
            'name' => 'New User',
        ]);
    }

    public function test_lead_magnet_guide_returns_200_after_submit(): void
    {
        $this->post('/free-renovation-guide', [
            'email' => 'guide@example.com',
            'name' => 'Guide User',
        ]);

        $response = $this->get('/free-renovation-guide/guide');
        $response->assertStatus(200);
        $this->assertStringContainsString('no-store', $response->headers->get('Cache-Control'));
    }

    public function test_contact_validation_fails_without_email(): void
    {
        $response = $this->post('/contact', [
            'name' => 'Test',
            'service' => 'residential',
        ]);

        $response->assertSessionHasErrors('email');
    }

    public function test_contact_validation_fails_without_service(): void
    {
        $response = $this->post('/contact', [
            'name' => 'Test',
            'email' => 'test@example.com',
        ]);

        $response->assertSessionHasErrors('service');
    }

    public function test_quote_partial_validation_fails_with_invalid_service(): void
    {
        $response = $this->postJson('/quote/partial', [
            'name' => 'Test',
            'email' => 'test@example.com',
            'service' => 'invalid-service',
        ]);

        $response->assertStatus(422);
    }

    public function test_lead_magnet_throttle_blocks_excessive_requests(): void
    {
        for ($i = 0; $i < 5; $i++) {
            $this->post('/free-renovation-guide', [
                'email' => 'throttle' . $i . '@example.com',
                'name' => 'Test',
            ]);
        }

        $response = $this->post('/free-renovation-guide', [
            'email' => 'throttle6@example.com',
            'name' => 'Test',
        ]);

        $response->assertStatus(429);
    }
}
