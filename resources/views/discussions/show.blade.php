@extends('layouts.layout')
@section('title', 'LibraryAI')

@section('content')
    <h1>{{ $discussion->title }}</h1>

    <p><strong>Категория:</strong> {{ $discussion->discussionCategory->name ?? 'Без категории' }}</p>
    <p><strong>Автор:</strong> {{ $discussion->author->login ?? 'Неизвестный автор' }}</p>

    <!-- Статус + редактирование -->
    @if(session('edit_discussion_id') == $discussion->id)
        <form action="{{ route('discussions.update', $discussion) }}" method="POST" style="margin-bottom: 1rem;">
            @csrf
            @method('PUT')
            <label for="status">Статус:</label>
            <input type="text" name="status" id="status" value="{{ old('status', $discussion->status) }}" required>
            <button type="submit">Сохранить</button>
            <a href="{{ url()->current() }}">Отмена</a>
        </form>
    @else
        <p><strong>Статус:</strong> {{ $discussion->status }}</p>

        @can('update', $discussion)
            <form action="{{ route('discussions.edit', $discussion) }}" method="GET" style="display:inline">
                <button type="submit">Редактировать статус</button>
            </form>
        @endcan
    @endif

    <!-- Описание и текст -->
    <p><strong>Описание:</strong> {{ $discussion->description }}</p>
    <p><strong>Текст:</strong> {{ $discussion->text }}</p>

    <!-- Превью -->
    @if($discussion->preview)
        <img src="{{ asset('storage/' . $discussion->preview) }}" alt="Превью" style="max-width: 400px;">
    @endif

    <!-- Удаление -->
    @can('delete', $discussion)
        <form action="{{ route('discussions.destroy', $discussion) }}" method="POST" style="margin-top:10px;">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm('Вы уверены, что хотите удалить обсуждение?')">Удалить обсуждение</button>
        </form>
    @endcan


    <hr>

    <h2>Чат</h2>
    @if($discussion->comments->count())
        <ul>
            @foreach($discussion->comments as $comment)
                <li>
                    <p><strong>{{ $comment->user->login}}</strong></p>

                    @if(session('edit_comment_id') == $comment->id)
                        <!-- Форма редактирования -->
                        <form action="{{ route('comments.update', $comment) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <textarea name="text" rows="3" required>{{ old('text', $comment->text) }}</textarea>
                            <br>
                            <button type="submit">Сохранить</button>
                            <a href="{{ url()->current() }}">Отмена</a>
                        </form>
                    @else
                        <p>{{ $comment->text }}</p>

                        @can('update', $comment)
                            <form action="{{ route('comments.edit', $comment) }}" method="GET" style="display:inline">
                                <button type="submit">Редактировать</button>
                            </form>
                        @endcan
                    @endif

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
