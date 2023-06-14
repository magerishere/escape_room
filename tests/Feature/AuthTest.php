<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class AuthTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_login_route_exists(): void
    {
        $response = $this->post(route('api.v1.auth.login'));

        $response->assertStatus(422);
    }

    public function test_user_can_login_with_correct_data()
    {
        $user = User::factory()->create();
        $response = $this->post(route('api.v1.auth.login'), [
            'email' => $user->email,
            'password' => 'password',
        ]);
        $response->assertStatus(200);
        Sanctum::actingAs($user);
        $this->assertAuthenticatedAs($user);
    }

    public function test_user_can_not_login_with_wrong_data()
    {
        $user = User::factory()->create();
        $response = $this->post(route('api.v1.auth.login'), [
            'email' => $user->email,
            'password' => 'wrong_password'
        ]);
        $response->assertStatus(401);
        $this->assertGuest();
    }

    public function test_user_can_logout()
    {
        $user = User::factory()->create();
        $response = $this->post(route('api.v1.auth.login'), [
            'email' => $user->email,
            'password' => 'password',
        ]);
        $response->assertStatus(200);
        Sanctum::actingAs($user);
        $response = $this->post(route('api.v1.auth.logout'));
        $response->assertStatus(200);
        $this->assertCount(0, $user->tokens);
    }

    public function test_guest_can_not_be_logout()
    {
        $response = $this->post(route('api.v1.auth.logout'));
        $response->assertStatus(403);
    }
}
