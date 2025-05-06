<?php

namespace App\Http\Controllers;

use App\Http\Requests\DiscussionRequest;
use App\Models\Discussion;
use App\Models\DiscussionCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiscussionController extends Controller
{
    public function index()
    {
        $discussions = Discussion::all();
        return view('discussions.index', compact('discussions'));
    }
    public function create()
    {
        $categories = DiscussionCategory::all();
        return view('discussions.create', compact('categories'));
    }

    public function store(DiscussionRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('preview')) {
            $data['preview'] = $request->file('preview')->store('previews', 'public');
        }

        $data['author_id'] = Auth::id();

        Discussion::create($data);

        return redirect()->route('discussions.index')->with('success', 'Обсуждение создано!');
    }
    public function show(Discussion $discussion)
    {
        return view('discussions.show', compact('discussion'));
    }
    public function edit(string $id)
    {
        //
    }
    public function update(Request $request, string $id)
    {
        //
    }
    public function destroy(string $id)
    {
        //
    }
}
