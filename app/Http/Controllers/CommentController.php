<?php
namespace App\Http\Controllers;
use App\Http\Requests\CommentCreateRequest;
use App\Http\Requests\CommentUpdateRequest;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
class CommentController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Comment::class, 'comment');
    }
    public function store(CommentCreateRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();
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
    public function edit(Comment $comment)
    {
        $this->authorize('update', $comment);
        return back()->with('edit_comment_id', $comment->id);
    }
    public function update(CommentUpdateRequest $request, Comment $comment)
    {
        $this->authorize('update', $comment);
        $validated = $request->validated();
        $comment->update(['text' => $validated['text']]);
        if ($comment->article_id) {
            return redirect()->route('articles.show', $comment->article_id)->with('success', 'Комментарий обновлён!');
        }
        if ($comment->discussion_id) {
            return redirect()->route('discussions.show', $comment->discussion_id)->with('success', 'Комментарий обновлён!');
        }
        return back()->with('success', 'Комментарий обновлён!');
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
