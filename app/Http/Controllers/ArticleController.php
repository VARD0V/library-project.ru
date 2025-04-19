<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use App\Models\ArticleCategory;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    //Просмотр всех статей.
    public function index()
    {
        $articles = Article::all();
        return view('articles.index', compact('articles'));
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
        // Создаем новую статью
        $article = new Article();
        $article->fill($validatedData); // Заполняем модель валидированными данными
        // Добавляем заглушку для author_id (можно заменить на реального пользователя после реализации аутентификации)
        $article->author_id = 1; // Фиксированный ID для тестирования
        // Проверяем, загружено ли изображение
        if ($request->hasFile('preview')) {
            // Сохраняем файл в папку 'previews' внутри storage/app/public
            $path = $request->file('preview')->store('previews', 'public');
            $article->preview = $path; // Сохраняем путь к файлу в базу данных
        }
        // Сохраняем статью в базу данных
        $article->save();
        return redirect()->route('articles.index')->with('success', 'Статья успешно создана!');
    }
    //        $article = Article::create($request->validated());
    //        return redirect()->route(route: 'articles.index');
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
