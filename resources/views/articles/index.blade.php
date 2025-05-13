@extends('layouts.layout')
@section('title', 'LibraryAI')

@section('content')
    @can('create', App\Models\Article::class)
        <div class="create-link">
            <a href="{{ route('articles.create') }}">Создать новую статью</a>
        </div>
    @endcan
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
                            {{Str::words(strip_tags($article->text), 100, '...') }}
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
