<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Idea;
use App\Models\User;
use Illuminate\Http\Request;

class IdeaController extends Controller
{
    public function index()
    {
        $ideas = Idea::latest()->paginate(5);
        return view('admin.ideas.index', compact('ideas'));
    }

    public function destroy(Idea $idea)
    {
        $this->authorize('delete', $idea);
        $idea->delete();
        return redirect(route('admin.ideas'))->with('success', 'Idea was deleted!');
    }
}
