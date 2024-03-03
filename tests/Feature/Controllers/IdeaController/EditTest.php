<?php

namespace Tests\Feature\Controllers\IdeaController;

use App\Models\Idea;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EditTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    /** @test */
    public function it_returns_edit_view_with_idea(): void
    {
        $idea = Idea::factory()->create();
        $user = $idea->user;
        $this->actingAs($user);

        $response = $this->get(route('ideas.edit', ['idea' => $idea]));

        $response->assertViewIs('ideas.show');
        $response->assertViewHas('idea', $idea);
        $response->assertViewHas('editing', true);
    }
}
