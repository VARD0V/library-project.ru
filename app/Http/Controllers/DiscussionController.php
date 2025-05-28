<?php
namespace App\Http\Controllers;
use App\Http\Requests\DiscussionCreateRequest;
use App\Http\Requests\DiscussionUpdateRequest;
use App\Models\Discussion;
use App\Models\DiscussionCategory;
use Illuminate\Support\Facades\Auth;
class DiscussionController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Discussion::class, 'discussion');
    }
    public function index()
    {
        // Получаем параметры из GET-запроса
        $search = request('search');
        $categoryId = request('category');
        // Загружаем все категории для фильтрации
        $categories = DiscussionCategory::all();
        // Базовый запрос
        $query = Discussion::query();
        // Фильтр по категории
        if ($categoryId) {
            $query->where('article_category_id', $categoryId);
        }
        // Поиск по заголовку или описанию
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }
        // Получаем результат
        $discussions = $query->get();
        return view('discussions.index', compact('discussions', 'categories'));
    }
    public function create()
    {
        $categories = DiscussionCategory::all();
        return view('discussions.create', compact('categories'));
    }
    public function store(DiscussionCreateRequest $request)
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
    public function edit(Discussion $discussion)
    {
        $this->authorize('update', $discussion);
        return back()->with('edit_discussion_id', $discussion->id);
    }
    public function update(DiscussionUpdateRequest $request, Discussion $discussion)
    {
        $data = $request->validated();
        if ($request->hasFile('preview')) {
            if ($discussion->preview && file_exists(storage_path('app/public/' . $discussion->preview))) {
                unlink(storage_path('app/public/' . $discussion->preview));
            }
            $data['preview'] = $request->file('preview')->store('previews', 'public');
        }
        $discussion->update($data);
        return redirect()->route('discussions.index')->with('success', 'Обсуждение успешно обновлено!');
    }
    public function destroy(Discussion $discussion)
    {
        $this->authorize('delete', $discussion);
        $discussion->delete();
        return redirect()->route('discussions.index')->with('success', 'Обсуждение удалено.');
    }
}
