<?php

namespace Tests\Feature\Controllers\IdeaController;

use App\Models\Idea;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateTest extends TestCase
{
    use RefreshDatabase;

    /**
     *
     * A basic feature test example.
     */
    /** @test */
    public function it_updates_an_idea_with_valid_data(): void
    {
        $idea = Idea::factory()->create();
        $user = $idea->user;
        $this->actingAs($user);

        $newContent = 'Updated idea content.';

        $response = $this->put(route('ideas.update', ['idea' => $idea]), [
            'content' => $newContent,
        ]);

        $response->assertRedirect(route('ideas.show', ['idea' => $idea]));
        $response->assertSessionHas('success', 'Idea updated successfully');


        $this->assertDatabaseHas('ideas', [
            'id' => $idea->id,
            'content' => $newContent,
        ]);
    }

    /** @test */
    public function it_requires_content_for_updating_an_idea(): void
    {
        $idea = Idea::factory()->create();
        $user = $idea->user;
        $this->actingAs($user);


        $response = $this->put(route('ideas.update', ['idea' => $idea]), []);

        $response->assertSessionHasErrors('content');
    }

    /** @test */
    public function it_only_updates_idea_when_user_is_authorized(): void
    {
        $idea = Idea::factory()->create();
        $user = User::factory()->create();
        $this->actingAs($user);


        $response = $this->put(route('ideas.update', ['idea' => $idea]), [
            'content' => 'Updated idea content.',
        ]);


        $response->assertStatus(403);
    }
}
