<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Idea;
use Illuminate\Http\Request;
use Illuminate\View\View;

class IdeaController extends Controller
{

    public function show(Idea $idea): View
    {
        return view('ideas.show', ['idea' => $idea]);
    }

    public function edit(Idea $idea): View
    {
        $this->authorize('update', $idea);
        $editing = true;
        return view('ideas.show', compact('idea', 'editing'));
    }

    public function update(Idea $idea)
    {
        $this->authorize('update', $idea);

        $validated = request()->validate([
            'content' => 'required|min:5|max:240'
        ]);

        $idea->update($validated);

        return redirect()->route('ideas.show', ['idea' => $idea])->with('success', 'Idea updated successfully');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'content' => 'required|min:5|max:240'
        ]);
        $validated['user_id'] = auth()->id();

        Idea::create($validated);
        return redirect(route('dashboard'))->with('success', 'Idea created successfully!');
    }

    public function destroy(Idea $idea)
    {
        $this->authorize('delete', $idea);
        $idea->delete();
        return redirect(route('dashboard'))->with('success', 'Idea was deleted!');
    }

}

