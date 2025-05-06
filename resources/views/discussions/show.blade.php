@extends('layouts.layout')
@section('title', 'LibraryAI')

@section('content')
    <h1>{{ $discussion->title }}</h1>

    <p><strong>Категория:</strong> {{ $discussion->discussionCategory->name ?? 'Без категории' }}</p>
    <p><strong>Автор:</strong> {{ $discussion->author->login ?? 'Неизвестный автор' }}</p>
    <p><strong>Описание:</strong> {{ $discussion->description }}</p>
    <p><strong>Текст:</strong> {{ $discussion->text }}</p>

    @if($discussion->preview)
        <img src="{{ asset('storage/' . $discussion->preview) }}" alt="Превью" style="max-width: 400px;">
    @endif

    <hr>

    <h2>Чат</h2>
    @if($discussion->comments->count())
        <ul>
            @foreach($discussion->comments as $comment)
                <li>
                    <p><strong>{{ $comment->user->login}}</strong></p>
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
            <input type="hidden" name="discussion_id" value="{{ $discussion->id }}">
            <button type="submit">Отправить</button>
        </form>
    @else
        <p>Только авторизованные пользователи могут писать сообщения.</p>
    @endauth

    <a href="{{ route('discussions.index') }}">← Назад к списку обсуждений</a>
@endsection
