<?php

namespace Tests\Feature\Controllers\IdeaController;

use App\Http\Controllers\IdeaController;
use App\Models\Idea;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Tests\TestCase;

class StoreTest extends TestCase
{

    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    /** @test */
    public function it_stores_an_idea(): void
    {
        $userData = [
            'content' => 'This is a test idea.',
        ];
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post(route('ideas.store'), $userData);


        $response->assertRedirect(route('dashboard'));
        $response->assertSessionHas('success', 'Idea created successfully!');
        $this->assertDatabaseHas('ideas', $userData);
    }

    /** @test */
    public function it_requires_content_for_storing_an_idea(): void
    {
        $userData = [];
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post(route('ideas.store'), $userData);

        $response->assertSessionHasErrors('content');
    }

    /** @test */
    public function it_returns_correct_http_response_after_storing_an_idea(): void
    {
        $userData = [
            'content' => 'This is a test idea.',
        ];
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post(route('ideas.store'), $userData);

        $response->assertStatus(302);
    }

}
