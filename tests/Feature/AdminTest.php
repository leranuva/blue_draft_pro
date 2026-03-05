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

    public function test_admin_accessible_when_authenticated(): void
    {
        $user = User::factory()->create([
            'email' => 'admin@bluedraft.cc',
        ]);

        $response = $this->actingAs($user)->get('/system-bd-access');

        $response->assertSuccessful();
    }
}
