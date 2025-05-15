@extends('layouts.layout')
@section('title', 'LibraryAI')
@section('content')
    <div class="search-and-filter">
        <form action="{{ route('articles.index') }}" method="GET" autocomplete="off">
            <!-- Поле поиска -->
            <input type="text" name="search" placeholder="Поиск по заголовкам и описанию..." value="{{ request('search') }}">
            <!-- Выбор категории -->
            <select name="category" id="category">
                <option value="">Все категории</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            <!-- Кнопка отправки формы -->
            <button class="articles-button" type="submit">Найти</button>
        </form>
        @auth
            <a href="{{route('articles.create')}}" class="btn-create">Создать статью</a>
        @endauth
    </div>
    <div class="articles-container">
        @foreach ($articles as $article)
            <a href="{{ route('articles.show', $article) }}" class="article-link">
                <div class="article-card-horizontal">
                    <img src="{{ $article->preview ? asset('storage/' . $article->preview) : asset('assets/images/main-page2.png') }}"
                         alt="Preview" class="article-image-horizontal">

                    <div class="article-details">
                        <h2 class="article-title">{{ $article->title }}</h2>
                        <p class="article-description">{{ $article->description }}</p>
                        <p class="article-text">
                            {{Str::words(strip_tags($article->text), 30, '...') }}
                        </p>
                        <div class="article-meta-horizontal">
                            <span>{{ $article->articleCategory->name }}</span>
                            <span>{{ $article->author->login }}</span>
                        </div>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
@endsection
