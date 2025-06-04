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
        // Автоматически применяет политику (CommentPolicy) ко всем методам
        $this->authorizeResource(Comment::class, 'comment');
    }
    //Создание нового комментария
    public function store(CommentCreateRequest $request)
    {
        // Получаем валидированные данные и добавляем ID текущего пользователя
        $data = $request->validated();
        $data['user_id'] = Auth::id();
        // Создаем комментарий
        $comment = Comment::create($data);
        // Перенаправляем обратно с сообщением в зависимости от типа комментария
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
    //Редактирование комментария (возвращает ID для фронтенда)
    public function edit(Comment $comment)
    {
        // Проверка прав выполняется автоматически через authorizeResource()
        return back()->with('edit_comment_id', $comment->id);
    }
    //Обновление комментария
    public function update(CommentUpdateRequest $request, Comment $comment)
    {
        // Проверка прав выполняется автоматически через authorizeResource()
        $validated = $request->validated();
        // Обновляем только текст комментария
        $comment->update(['text' => $validated['text']]);
        // Перенаправляем обратно с сообщением в зависимости от типа комментария
        if ($comment->article_id) {
            return redirect()->route('articles.show', $comment->article_id)
                ->with('success', 'Комментарий обновлён!');
        }
        if ($comment->discussion_id) {
            return redirect()->route('discussions.show', $comment->discussion_id)
                ->with('success', 'Комментарий обновлён!');
        }
        return back()->with('success', 'Комментарий обновлён!');
    }
    //Удаление комментария
    public function destroy(Comment $comment)
    {
        // Сохраняем ID связанных сущностей перед удалением
        $articleId = $comment->article_id;
        $discussionId = $comment->discussion_id;
        // Удаляем комментарий
        $comment->delete();
        // Перенаправляем обратно с сообщением в зависимости от типа комментария
        if ($articleId) {
            return redirect()->route('articles.show', $articleId)
                ->with('success', 'Комментарий удалён!');
        }
        if ($discussionId) {
            return redirect()->route('discussions.show', $discussionId)
                ->with('success', 'Комментарий удалён!');
        }
        return back()->with('success', 'Комментарий удалён!');
    }
}
