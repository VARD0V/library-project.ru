@extends('layouts.layout')
@section('title', 'LibraryAI')
@section('content')
    <div class="create-container">
        <h1>Создание статьи | внимательно проверьте содержимое и после публикуйте свою работу :)</h1>
    </div>
    <div class="create-container">
        <form style="display: flex; flex-direction: column; gap: 10px" action="{{ isset($article) ? route('articles.update', $article) : route('articles.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($article))
                @method('PUT')
            @endif
            <div class="create-div">
                <div>
                    <label class="create-label" for="title">Заголовок:</label>
                    <input class="text-input" type="text" name="title" id="title" value="{{ old('title', $article->title ?? '') }}" required>
                </div>
                <div>
                    <label class="create-label" for="article_category_id">Категория:</label>
                    <select class="select" name="article_category_id" id="article_category_id" required>
                        <option value="">Выберите категорию</option>
                        @foreach ($articleCategories as $category)
                            <option value="{{ $category->id }}" {{ isset($article) && $article->article_category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="create-label" for="preview">Превью</label>
                    <input class="file-input" type="file" name="preview" id="preview">
                    @if(isset($article) && $article->preview)
                        <img src="{{ asset('storage/' . $article->preview) }}" alt="Превью" style="max-width: 200px; margin-top: 10px;">
                    @endif
                </div>
            </div>
            <div>
                <label class="create-label" for="description">Описание</label>
                <textarea rows="3" class="comment-input" name="description" id="description">{{ old('description', $article->description ?? '') }}</textarea>
            </div>
            <div>
                <label class="create-label" for="text">Текст статьи</label>
                <textarea rows="5" class="comment-input" name="text" id="text" required>{{ old('text', $article->text ?? '') }}</textarea>
            </div>
            <button class="articles-button" type="submit">{{ isset($article) ? 'Обновить' : 'Создать' }}</button>
        </form>
</div>
@endsection
