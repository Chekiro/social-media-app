<?php

namespace Tests\Feature\Controllers\IdeaController;

use App\Models\Idea;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DestroyTest extends TestCase
{

    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    /** @test */
    public function it_deletes_an_idea(): void
    {
        $idea = Idea::factory()->create();
        $user = $idea->user;
        $this->actingAs($user);

        $response = $this->delete(route('ideas.destroy', ['idea' => $idea]));


        $response->assertRedirect(route('dashboard'));
        $response->assertSessionHas('success', 'Idea was deleted!');


        $this->assertDatabaseMissing('ideas', ['id' => $idea->id]);
    }

    /** @test */
    public function it_only_deletes_idea_when_user_is_authorized(): void
    {
        $idea = Idea::factory()->create();
        $user = User::factory()->create();
        $this->actingAs($user);


        $response = $this->delete(route('ideas.destroy', ['idea' => $idea]));

        $response->assertStatus(403);

        $this->assertDatabaseHas('ideas', ['id' => $idea->id]);
    }
}
