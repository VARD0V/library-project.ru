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
        $this->authorizeResource(Article::class, 'article');
    }
    //Просмотр всех статей.
    public function index()
    {
        // Получаем параметры из GET-запроса
        $search = request('search');
        $categoryId = request('category');
        // Загружаем все категории для фильтрации
        $categories = ArticleCategory::all();
        // Базовый запрос
        $query = Article::query();
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
        $articles = $query->get();
        return view('articles.index', compact('articles', 'categories'));
    }
    //Просмотр конкретной статьи
    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }
    //Показ формы для создания новой статьи
    public function create()
    {
        $articleCategories = ArticleCategory::all(); // Получаем все категории статей
        return view('articles.create', compact( 'articleCategories'));
    }
    //Сохранение новой статьи в базе данных
    public function store(ArticleCreateRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['author_id'] = Auth::id();
        if ($request->hasFile('preview')) {
            $validatedData['preview'] = $request->file('preview')->store('previews', 'public');
        }
        Article::create($validatedData);
        return redirect()->route('articles.index')->with('success', 'Статья успешно создана!');
    }
    //Показ формы для редактирования статьи
    public function edit(Article $article)
    {
        $articleCategories = ArticleCategory::all(); // Получаем все категории статей
        return view('articles.edit', compact('article', 'articleCategories'));
    }
    //Обновление статьи в базе данных
    public function update(ArticleUpdateRequest $request, Article $article)
    {
        $validatedData = $request->validated();
        if ($request->hasFile('preview')) {
            if ($article->preview) {
                Storage::delete($article->preview);
            }
            $validatedData['preview'] = $request->file('preview')->store('previews', 'public');
        }
        $article->update($validatedData);
        return redirect()->route('articles.index')->with('success', 'Статья успешно обновлена!');
    }
    //Удаление статьи из базы данных.
    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()->route('articles.index')->with('success', 'Статья успешно удалена!');
    }
}
