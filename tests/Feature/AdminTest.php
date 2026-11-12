<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
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

    public function test_internal_presentations_require_the_admin_panel(): void
    {
        $this->get('/system-bd-access/project-proposal')->assertRedirect();

        $user = User::factory()->create(['is_admin' => true]);
        $this->actingAs($user)->get('/system-bd-access/project-proposal')->assertRedirect();

        $user->saveAppAuthenticationSecret('JBSWY3DPEHPK3PXP');
        $this->get('/system-bd-access/project-proposal')->assertOk();
    }
}
