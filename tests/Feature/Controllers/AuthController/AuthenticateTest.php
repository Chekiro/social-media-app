<?php

namespace Tests\Feature\Controllers\AuthController;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthenticateTest extends TestCase
{

    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    /** @test */
    public function it_authenticates_user_with_correct_credentials(): void
    {
        $user = User::factory()->create([
            'email' => 'john@example.com',
            'password' => bcrypt('password123'),
        ]);

        $response = $this->post(route('login'), [
            'email' => 'john@example.com',
            'password' => 'password123',
        ]);

        $response->assertRedirect(route('dashboard')); // Asercja przekierowania na stronę pulpitu
        $response->assertSessionHas('success', 'Login Successfully!'); // Asercja o sukcesie uwierzytelnienia
    }


    /** @test */
    public function it_requires_valid_credentials_for_authentication(): void
    {
        $user = User::factory()->create([
            'email' => 'john@example.com',
            'password' => bcrypt('password123'),
        ]);

        $response = $this->post(route('login'), [
            'email' => 'john@example.com',
            'password' => 'wrongpassword',
        ]);

        $response->assertRedirect(route('login'));
        $response->assertSessionHasErrors('email');
    }

}
