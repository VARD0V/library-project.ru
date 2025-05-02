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
                <li style="margin-bottom: 15px;">
                    <p><strong>{{ $comment->user->login ?? 'Аноним' }}:</strong></p>
                    <p>{{ $comment->text }}</p>
                </li>
            @endforeach
        </ul>
    @else
        <p>Комментариев пока нет.</p>
    @endif

    <a href="{{ route('discussions.index') }}">← Назад к списку обсуждений</a>
@endsection
