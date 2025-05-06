<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Comment::class, 'comment');
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
    public function edit(string $id)
    {
        //
    }
    public function update(Request $request, string $id)
    {
        //
    }
    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);
        $articleId = $comment->article_id;
        $discussionId = $comment->discussion_id;
        $comment->delete();
        if ($articleId) {
            return redirect()->route('articles.show', $articleId)->with('success', 'Комментарий удалён!');
        }
        if ($discussionId) {
            return redirect()->route('discussions.show', $discussionId)->with('success', 'Комментарий удалён!');
        }
        return back()->with('success', 'Комментарий удалён!');
    }

}
