@extends('layouts.layout')
@section('title', 'LibraryAI')
@section('content')
    <div class="create-container">
        <h1>Редактирование статьи | внимательно проверьте содержимое перед сохранением</h1>
    </div>
    <div class="create-container">
        <form style="display: flex; flex-direction: column; gap: 10px" action="{{ route('articles.update', $article) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="create-div">
                <div>
                    <label class="create-label" for="title">Заголовок:</label>
                    <input class="text-input" type="text" name="title" id="title" value="{{ old('title', $article->title) }}" required>
                </div>
                <div>
                    <label class="create-label" for="article_category_id">Категория:</label>
                    <select class="select" name="article_category_id" id="article_category_id" required>
                        <option value="">Выберите категорию</option>
                        @foreach ($articleCategories as $category)
                            <option value="{{ $category->id }}" {{ $article->article_category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div style="display: flex; align-items: center; gap: 10px; flex-wrap: wrap">
                    <label class="create-label" for="preview">Превью</label>
                    <input class="file-input" type="file" name="preview" id="preview">
                    @if($article->preview)
                        <img src="{{ asset('storage/' . $article->preview) }}" alt="Текущее превью" style="max-width: 200px">
                    @endif
                </div>
            </div>
            <div>
                <label class="create-label" for="description">Описание</label>
                <textarea rows="3" class="comment-input" name="description" id="description">{{ old('description', $article->description) }}</textarea>
            </div>
            <div>
                <label class="create-label" for="text">Текст статьи</label>
                <textarea rows="5" class="comment-input" name="text" id="text" required>{{ old('text', $article->text) }}</textarea>
            </div>
            @if ($errors->any())
                <div class="warning">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div style="margin-top: 20px; display: flex; justify-content: center; align-items: center; gap: 20px">
                <button class="articles-button" type="submit">Обновить</button>
                <a class="btn-edit" href="{{ route('articles.show', $article) }}">Отмена</a>
            </div>
        </form>
    </div>
    <div class="back-btn">
        <a href="{{ route('articles.index') }}">
            <svg height="50px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M9 22H15C20 22 22 20 22 15V9C22 4 20 2 15 2H9C4 2 2 4 2 9V15C2 20 4 22 9 22Z" stroke="#212121" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M9.00002 15.3802H13.92C15.62 15.3802 17 14.0002 17 12.3002C17 10.6002 15.62 9.22021 13.92 9.22021H7.15002" stroke="#212121" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M8.57 10.7701L7 9.19012L8.57 7.62012" stroke="#212121" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </a>
    </div>
@endsection
