<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleCategory;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    //Просмотр всех статей.
    public function index()
    {
        $articles = Article::all();
        return view('articles.index', compact('articles'));
    }
//    //Показ формы для создания новой статьи
//    public function create()
//    {
//        return view('articles.create');
//    }
//    //Сохранение новой статьи в базе данных
//    public function store(Request $request)
//    {
//        // Валидация данных выполнена в CreateArticleRequest
//        $data = $request->validated();
//        // Если загружено изображение превью
//        if ($request->hasFile('preview')) {
//            $path = $request->file('preview')->store('previews', 'public');
//            $data['preview'] = $path;
//        }
//        // Создаем статью
//        $article = Article::create($data);
//        return redirect()->route('articles.show', $article)->with('success', 'Статья успешно создана!');
//    }
//    //Просмотр конкретной статьи
    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }
//    //Показ формы для редактирования статьи
    public function edit(Article $article)
    {
        $articleCategories = ArticleCategory::all(); // Получаем все категории статей
        return view('articles.edit', compact('article', 'articleCategories'));
    }
//    //Обновление статьи в базе данных
//    public function update(Request $request, string $id)
//    {
//        // Валидация данных выполнена в CreateArticleRequest
//        $data = $request->validated();
//        // Если загружено новое изображение превью
//        if ($request->hasFile('preview')) {
//            $path = $request->file('preview')->store('previews', 'public');
//            $data['preview'] = $path;
//        }
//        // Обновляем статью
//        $article->update($data);
//        return redirect()->route('articles.show', $article)->with('success', 'Статья успешно обновлена!');
//    }
//    //Удаление статьи из базы данных.
//    public function destroy(string $id)
//    {
//        $article->delete();
//        return redirect()->route('articles.index')->with('success', 'Статья успешно удалена!');
//    }
}
