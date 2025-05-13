<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequest;
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
    public function store(ArticleRequest $request)
    {
        // Валидация данных выполнена в ArticleRequest
        $validatedData = $request->validated();
        // Устанавливаем автора статьи — текущего пользователя
        $validatedData['author_id'] = Auth::id();
        // Проверяем, загружено ли изображение
        if ($request->hasFile('preview')) {
            // Сохраняем файл в папку 'previews' внутри storage/app/public
            $path = $request->file('preview')->store('previews', 'public');
            $validatedData['preview'] = $path; // Обновляем путь к изображению
        }
        // Создаем и сохраняем статью
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
    public function update(ArticleRequest $request, Article $article)
    {
        // Валидация данных выполнена в ArticleRequest
        $validatedData = $request->validated();
        // Проверяем, загружено ли новое изображение
        if ($request->hasFile('preview')) {
            // Удаляем старое изображение, если оно существует
            if ($article->preview) {
                Storage::delete($article->preview);
            }
            // Сохраняем новое изображение
            $path = $request->file('preview')->store('previews', 'public');
            $validatedData['preview'] = $path; // Обновляем путь к изображению
        }
        // Обновляем статью
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
