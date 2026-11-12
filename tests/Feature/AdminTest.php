<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Quote;
use App\Filament\Resources\Quotes\Pages\EditQuote;
use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\TestCase;

class AdminTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_redirects_to_login_when_guest(): void
    {
        $response = $this->get('/system-bd-access');

        $response->assertRedirect();
        $this->assertStringContainsString('login', $response->headers->get('Location'));
    }

    public function test_corporate_email_alone_does_not_grant_admin_access(): void
    {
        $user = User::factory()->create([
            'email' => 'admin@bluedraft.cc',
        ]);

        $response = $this->actingAs($user)->get('/system-bd-access');

        $response->assertForbidden();
    }

    public function test_administrator_must_enroll_in_mfa(): void
    {
        $user = User::factory()->create(['is_admin' => true]);

        $this->actingAs($user)->get('/system-bd-access')->assertRedirect();
    }

    public function test_filament_modal_renders_without_a_footer_slot(): void
    {
        $html = Blade::render('<x-filament::modal id="admin-modal">Modal content</x-filament::modal>');

        $this->assertStringContainsString('Modal content', $html);
    }

    public function test_admin_can_download_a_private_quote_attachment_from_edit_page(): void
    {
        $user = User::factory()->create(['is_admin' => true]);
        $user->saveAppAuthenticationSecret('JBSWY3DPEHPK3PXP');
        $this->actingAs($user);
        Filament::setCurrentPanel(Filament::getPanel('admin'));

        Storage::fake('quote_attachments');
        $quote = Quote::factory()->create();
        $path = "quotes/{$quote->id}/test.jpg";
        Storage::disk('quote_attachments')->put($path, 'test image');
        $attachment = $quote->attachments()->create([
            'file_path' => $path,
            'original_name' => 'test.jpg',
            'file_type' => 'image/jpeg',
            'file_size' => 10,
        ]);

        Livewire::test(EditQuote::class, ['record' => $quote->getRouteKey()])
            ->assertSee('Attachments')
            ->callAction('downloadAttachment' . $attachment->id)
            ->assertFileDownloaded('test.jpg');
    }

    public function test_internal_presentations_require_the_admin_panel(): void
    {
        $this->get('/system-bd-access/project-proposal')->assertRedirect();

        $user = User::factory()->create(['is_admin' => true]);
        $this->actingAs($user)->get('/system-bd-access/project-proposal')->assertRedirect();

        $user->saveAppAuthenticationSecret('JBSWY3DPEHPK3PXP');
        $this->get('/system-bd-access/project-proposal')->assertOk();
    }
}
