<?php

namespace Tests\Feature\Controllers\IdeaController;

use App\Http\Controllers\IdeaController;
use App\Models\Idea;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\View\View;
use Tests\TestCase;

class ShowTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function show_method_returns_view_with_idea(): void
    {
        $idea = Idea::factory()->create();

        $controller = new IdeaController();

        $response = $controller->show($idea);

        $this->assertInstanceOf(View::class, $response);

        $this->assertEquals($idea->toArray(), $response->getData()['idea']->toArray());
    }


    /** @test */
    public function show_method_returns_404_for_nonexistent_idea(): void
    {
        $nonexistentIdeaId = 9999;

        $controller = new IdeaController();

        $this->expectException(ModelNotFoundException::class);

        $controller->show(Idea::findOrFail($nonexistentIdeaId));
    }
}



