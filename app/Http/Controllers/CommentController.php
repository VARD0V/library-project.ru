<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        //
    }
    public function create()
    {
        //
    }
    public function store(CommentRequest $request)
    {
        $request->validated();
        $data = $request->validated();
        $data['user_id'] = auth()->id(); // добавляем вручную, т.к. не вводится с формы
        Comment::create($data);
        if ($request->filled('article_id')) {
            return redirect()->route('articles.show', $request->input('article_id'))
                ->with('success', 'Комментарий добавлен!');
        }
        if ($request->filled('discussion_id')) {
            return redirect()->route('discussions.show', $request->input('discussion_id'))
                ->with('success', 'Комментарий добавлен!');
        }
        return back()->withErrors('Комментарий не привязан ни к статье, ни к обсуждению.');
    }
    public function show(string $id)
    {
        //
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
