<?php

namespace Tests\Feature;

use App\Jobs\AddLeadToEmailSequence;
use App\Models\LeadMagnetSubscriber;
use App\Models\Quote;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class FormsTest extends TestCase
{
    use RefreshDatabase;

    public function test_quote_complete_updates_quote_and_redirects(): void
    {
        Mail::fake();
        Queue::fake();

        $quote = Quote::create([
            'client_name' => 'Test User',
            'email' => 'test@example.com',
            'service_type' => 'residential',
            'is_partial' => true,
            'step' => 1,
            'status' => 'pending',
            'stage' => Quote::STAGE_NEW,
        ]);

        $response = $this->post('/quote/complete', [
            'quote_id' => $quote->id,
            'phone' => '5551234567',
            'address' => '123 Test St',
            'budget' => '50k-100k',
            'message' => 'Test message',
            'g-recaptcha-response' => '',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $quote->refresh();
        $this->assertFalse($quote->is_partial);
        $this->assertSame('5551234567', $quote->phone);
        $this->assertSame('123 Test St', $quote->address);

        Queue::assertPushed(AddLeadToEmailSequence::class);
    }

    public function test_quote_complete_fails_with_invalid_quote_id(): void
    {
        $response = $this->post('/quote/complete', [
            'quote_id' => 99999,
            'g-recaptcha-response' => '',
        ]);

        $response->assertSessionHasErrors('quote_id');
    }

    public function test_quote_complete_fails_when_quote_already_completed(): void
    {
        $quote = Quote::create([
            'client_name' => 'Test',
            'email' => 'test@example.com',
            'service_type' => 'residential',
            'is_partial' => false,
            'step' => 2,
            'status' => 'pending',
            'stage' => Quote::STAGE_NEW,
        ]);

        $response = $this->post('/quote/complete', [
            'quote_id' => $quote->id,
            'g-recaptcha-response' => '',
        ]);

        $response->assertSessionHasErrors('quote');
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
