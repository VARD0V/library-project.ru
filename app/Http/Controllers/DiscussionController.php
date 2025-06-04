<?php
namespace App\Http\Controllers;
use App\Http\Requests\DiscussionCreateRequest;
use App\Http\Requests\DiscussionUpdateRequest;
use App\Models\Discussion;
use App\Models\DiscussionCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DiscussionController extends Controller
{
    public function __construct()
    {
        // Автоматически применяет политику (DiscussionPolicy) ко всем методам
        $this->authorizeResource(Discussion::class, 'discussion');
    }
    //Отображение списка обсуждений с возможностью фильтрации
    public function index()
    {
        // Получаем параметры фильтрации из GET-запроса
        $search = request('search');
        $categoryId = request('category');
        // Загружаем все категории для выпадающего списка фильтров
        $categories = DiscussionCategory::all();
        // Базовый запрос с сортировкой по умолчанию (можно добавить ->latest())
        $query = Discussion::query();
        // Фильтр по категории
        if ($categoryId) {
            // Исправлено: было 'article_category_id', должно быть 'discussion_category_id'
            $query->where('discussion_category_id', $categoryId);
        }
        // Поиск по заголовку или описанию
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }
        // Получаем отфильтрованный результат
        $discussions = $query->get();
        return view('discussions.index', compact('discussions', 'categories'));
    }
    //Форма создания нового обсуждения
    public function create()
    {
        $categories = DiscussionCategory::all();
        return view('discussions.create', compact('categories'));
    }
    //Сохранение нового обсуждения
    public function store(DiscussionCreateRequest $request)
    {
        $data = $request->validated();
        // Обработка загрузки превью
        if ($request->hasFile('preview')) {
            $data['preview'] = $request->file('preview')->store('previews', 'public');
        }
        // Привязываем обсуждение к текущему пользователю
        $data['author_id'] = Auth::id();
        // Создаем обсуждение
        Discussion::create($data);
        return redirect()->route('discussions.index')->with('success', 'Обсуждение создано!');
    }
    //Просмотр конкретного обсуждения
    public function show(Discussion $discussion)
    {
        return view('discussions.show', compact('discussion'));
    }
    //Форма редактирования обсуждения
    public function edit(Discussion $discussion)
    {
        // Проверка прав выполняется автоматически через authorizeResource()
        return back()->with('edit_discussion_id', $discussion->id);
    }
    //Обновление обсуждения
    public function update(DiscussionUpdateRequest $request, Discussion $discussion)
    {
        $data = $request->validated();
        // Обработка обновления превью
        if ($request->hasFile('preview')) {
            // Удаляем старое изображение, если оно есть
            if ($discussion->preview) {
                Storage::disk('public')->delete($discussion->preview);
            }
            // Сохраняем новое изображение
            $data['preview'] = $request->file('preview')->store('previews', 'public');
        }
        // Обновляем обсуждение
        $discussion->update($data);
        return redirect()->route('discussions.index')->with('success', 'Обсуждение успешно обновлено!');
    }
    //Удаление обсуждения
    public function destroy(Discussion $discussion)
    {
        $discussion->delete();
        return redirect()->route('discussions.index')->with('success', 'Обсуждение удалено.');
    }
}
