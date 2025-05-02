@extends('layouts.layout')
@section('title', 'LibraryAI')
@section('content')
    <h1>{{ $article->title }}</h1>
    <p><strong>Категория:</strong> {{ $article->articleCategory->name }}</p>
    <p><strong>Описание:</strong> {{ $article->description }}</p>
    <p><strong>Текст:</strong> {{ $article->text }}</p>

    @if($article->preview)
        <img src="{{ asset('storage/' . $article->preview) }}" alt="Превью" style="max-width: 400px;">
    @endif

    <hr>

    <h2>Комментарии</h2>
    @if($article->comments->count())
        <ul>
            @foreach($article->comments as $comment)
                <li>
                    <p><strong>{{ $comment->user->login ?? 'Аноним' }}</strong></p>
                    <p>{{ $comment->text }}</p>
                </li>
            @endforeach
        </ul>
    @else
        <p>Комментариев пока нет.</p>
    @endif
    <form action="{{ route('comments.store') }}" method="POST">
        @csrf
        <textarea name="text" rows="4" required placeholder="Комментарий..."></textarea>
        <input type="hidden" name="article_id" value="{{ $article->id }}">
        <button type="submit">Отправить</button>
    </form>

    <a href="{{ route('articles.index') }}">Назад к списку</a>
@endsection
