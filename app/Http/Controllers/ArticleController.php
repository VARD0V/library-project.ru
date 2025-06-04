<?php
namespace App\Http\Controllers;
use App\Http\Requests\ArticleCreateRequest;
use App\Http\Requests\ArticleUpdateRequest;
use App\Models\Article;
use App\Models\ArticleCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
class ArticleController extends Controller
{
    public function __construct()
    {
        // Автоматически применяет политику (ArticlePolicy) ко всем методам контроллера
        // Например, для update() будет вызван метод update() в политике
        $this->authorizeResource(Article::class, 'article');
    }
    // Список статей с возможностью фильтрации и поиска
    public function index()
    {
        // Получаем параметры поиска и фильтра из GET-запроса
        $search = request('search');      // Поисковая строка
        $categoryId = request('category'); // ID категории для фильтрации
        // Все категории для выпадающего списка фильтра
        $categories = ArticleCategory::all();
        // Базовый запрос для получения статей
        $query = Article::query();
        // Фильтр по категории (если выбрана)
        if ($categoryId) {
            $query->where('article_category_id', $categoryId);
        }
        // Поиск по заголовку или описанию (если задан)
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }
        $articles = $query->get();
        return view('articles.index', compact('articles', 'categories'));
    }
    // Просмотр одной статьи
    public function show(Article $article)
    {
        // Laravel автоматически найдет статью по ID (Model Binding)
        return view('articles.show', compact('article'));
    }
    // Форма создания новой статьи
    public function create()
    {
        // Получаем все категории для выпадающего списка
        $articleCategories = ArticleCategory::all();
        return view('articles.create', compact('articleCategories'));
    }
    // Сохранение новой статьи
    public function store(ArticleCreateRequest $request)
    {
        // Валидация данных выполняется в ArticleCreateRequest
        $validatedData = $request->validated();
        // Привязываем статью к текущему пользователю
        $validatedData['author_id'] = Auth::id();
        // Если загружено изображение, сохраняем его в storage/public/previews
        if ($request->hasFile('preview')) {
            $validatedData['preview'] = $request->file('preview')->store('previews', 'public');
        }
        // Создаем статью и перенаправляем на список статей
        Article::create($validatedData);
        return redirect()->route('articles.index')->with('success', 'Статья успешно создана!');
    }
    // Форма редактирования статьи
    public function edit(Article $article)
    {
        $articleCategories = ArticleCategory::all();
        return view('articles.edit', compact('article', 'articleCategories'));
    }
    // Обновление статьи
    public function update(ArticleUpdateRequest $request, Article $article)
    {
        $validated = $request->validated();
        // Если загружено новое изображение
        if ($request->hasFile('preview')) {
            // Удаляем старое изображение (если оно было)
            if ($article->preview) {
                Storage::disk('public')->delete($article->preview);
            }
            // Сохраняем новое изображение
            $validated['preview'] = $request->file('preview')->store('previews', 'public');
        }
        $article->update($validated);
        return redirect()->route('articles.show', $article)->with('success', 'Статья успешно обновлена!');
    }
    // Удаление статьи
    public function destroy(Article $article)
    {
        // Если у статьи есть превью, удаляем файл из хранилища
        if ($article->preview) {
            Storage::disk('public')->delete($article->preview);
        }
        // Удаляем статью из БД
        $article->delete();
        return redirect()->route('articles.index')->with('success', 'Статья успешно удалена!');
    }
}
