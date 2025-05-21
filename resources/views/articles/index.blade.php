@extends('layouts.layout')
@section('title', 'LibraryAI | Статьи')
@section('content')
    <div class="search-and-filter">
        <form action="{{ route('articles.index') }}" method="GET" autocomplete="off">
            <input type="text" name="search" placeholder="Поиск по заголовкам и описанию..." value="{{ request('search') }}">
            <select name="category" id="category">
                <option value="">Все категории</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            <button class="articles-button" type="submit">Найти</button>
        </form>
        @auth
            <a href="{{route('articles.create')}}" class="btn-create">Создать статью</a>
        <div class="tooltip-container">
            <svg width="25px" height="25px" class="tooltip-container">
                <path fill-rule="evenodd" clip-rule="evenodd"
                      d="M12 2.75C6.89137 2.75 2.75 6.89137 2.75 12C2.75 17.1086 6.89137 21.25 12 21.25C17.1086 21.25 21.25 17.1086 21.25 12C21.25 6.89137 17.1086 2.75 12 2.75ZM1.25 12C1.25 6.06294 6.06294 1.25 12 1.25C17.9371 1.25 22.75 6.06294 22.75 12C22.75 17.9371 17.9371 22.75 12 22.75C6.06294 22.75 1.25 17.9371 1.25 12ZM12 7.75C11.3787 7.75 10.875 8.25368 10.875 8.875C10.875 9.28921 10.5392 9.625 10.125 9.625C9.71079 9.625 9.375 9.28921 9.375 8.875C9.375 7.42525 10.5503 6.25 12 6.25C13.4497 6.25 14.625 7.42525 14.625 8.875C14.625 9.83834 14.1056 10.6796 13.3353 11.1354C13.1385 11.2518 12.9761 11.3789 12.8703 11.5036C12.7675 11.6246 12.75 11.7036 12.75 11.75V13C12.75 13.4142 12.4142 13.75 12 13.75C11.5858 13.75 11.25 13.4142 11.25 13V11.75C11.25 11.2441 11.4715 10.8336 11.7266 10.533C11.9786 10.236 12.2929 10.0092 12.5715 9.84439C12.9044 9.64739 13.125 9.28655 13.125 8.875C13.125 8.25368 12.6213 7.75 12 7.75ZM12 17C12.5523 17 13 16.5523 13 16C13 15.4477 12.5523 15 12 15C11.4477 15 11 15.4477 11 16C11 16.5523 11.4477 17 12 17Z" fill="#FFFFFF"/>
            </svg>
            <span class="tooltip-text">Если вам есть чем поделиться - то опубликуйте статью!</span>
        </div>
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
