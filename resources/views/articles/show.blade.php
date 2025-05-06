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
                    <p><strong>{{ $comment->user->login }}</strong></p>
                    <p>{{ $comment->text }}</p>

                    @can('delete', $comment)
                        <form action="{{ route('comments.destroy', $comment) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Удалить комментарий?')">Удалить</button>
                        </form>
                    @endcan

                </li>
            @endforeach
        </ul>
    @else
        <p>Комментариев пока нет.</p>
    @endif
    @auth
        <form action="{{ route('comments.store') }}" method="POST">
            @csrf
            <textarea name="text" rows="4" required placeholder="Комментарий..."></textarea>
            <input type="hidden" name="article_id" value="{{ $article->id }}">
            <button type="submit">Отправить</button>
        </form>
    @else
        <p>Только авторизованные пользователи могут оставлять комментарии.</p>
    @endauth


    <a href="{{ route('articles.index') }}">Назад к списку</a>
@endsection
