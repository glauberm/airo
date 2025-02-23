<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_login(): void
    {
        $user = User::factory()->create();

        $response = $this->postJson('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertOk();
    }

    public function test_login_with_wrong_password(): void
    {
        $user = User::factory()->create();

        $response = $this->postJson('/login', [
            'email' => $user->email,
            'password' => 'passwrong',
        ]);

        $response->assertStatus(401);
    }

    public function test_logout(): void
    {
        $response = $this->getAuthorizedRequest()->postJson('/logout');

        $response->assertOk();
    }

    public function test_get_authenticated_user(): void
    {
        $response = $this->getAuthorizedRequest()->getJson('/authenticated-user');

        $response->assertOk();
    }

    public function test_refresh(): void
    {
        $response = $this->getAuthorizedRequest()->postJson('/refresh');

        $response->assertOk();
    }
}
