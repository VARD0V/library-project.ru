@extends('layouts.layout')
@section('title', 'LibraryAI')
@section('content')
    <div class="article-container">
        <div class="header-block">
            <h1>{{ $article->title }}</h1>
            @if($article->articleCategory || $article->description)
                <div class="meta">
                    @if($article->articleCategory)
                        <span class="category">{{ $article->articleCategory->name }}</span>
                    @endif
                    @if($article->description)
                        <span class="description">{{ $article->description }}</span>
                    @endif
                </div>
            @endif
        </div>

        <div class="content-block">
            <div class="image-wrapper">
                @if($article->preview)
                    <img src="{{ asset('storage/' . $article->preview) }}" alt="Превью">
                @endif
            </div>
            <div class="text-wrapper">
                <p>{{ $article->text }}</p>
            </div>
        </div>
    </div>
    <div class="comments-container">
        <h2>Комментарии</h2>

        @if($article->comments->count())
            <ul class="comments-list">
                @foreach($article->comments as $comment)
                    <li class="comment-item">
                        <div class="comment-header">
                            @if($comment->user->avatar_url && file_exists(public_path('storage/' . $comment->user->avatar_url)))
                                <img src="{{ asset('storage/' . $comment->user->avatar_url) }}" alt="Аватар" class="avatar">
                            @else
                                <img src="{{ asset('assets/images/anonim.jpg') }}" alt="Аватар" class="avatar">
                            @endif
                            <div class="user-info">
                                <strong>{{ $comment->user->login}}:</strong>
                            </div>
                        </div>
                        <div class="comment-body">
                            @if(session('edit_comment_id') == $comment->id)
                                <!-- Форма редактирования -->
                                <form action="{{ route('comments.update', $comment) }}" method="POST" class="edit-form">
                                    @csrf
                                    @method('PUT')
                                    <textarea name="text" rows="1" class="comment-input">{{ old('text', $comment->text) }}</textarea>
                                    <div class="action-buttons">
                                        <button class="articles-button-save" type="submit">Сохранить</button>
                                        <a href="{{ url()->current() }}">Отмена</a>
                                    </div>
                                </form>
                            @else
                                <p>{{ $comment->text }}</p>
                                <div class="comment-actions">
                                    @can('update', $comment)
                                        <form action="{{ route('comments.edit', $comment) }}" method="GET" style="display:inline">
                                            <button type="submit" class="btn-edit">Редактировать</button>
                                        </form>
                                    @endcan

                                    @can('delete', $comment)
                                        <form action="{{ route('comments.destroy', $comment) }}" method="POST" style="display:inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-delete" onclick="return confirm('Удалить комментарий?')">Удалить</button>
                                        </form>
                                    @endcan
                                </div>
                            @endif
                        </div>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="no-comments">Комментариев пока нет.</p>
        @endif

        @auth
            <div class="comment-form-container">
                <form action="{{ route('comments.store') }}" method="POST">
                    @csrf
                    <textarea name="text" rows="1" class="comment-input" placeholder="Комментарий..."></textarea>
                    <input type="hidden" name="article_id" value="{{ $article->id }}">
                    <button type="submit" class="comments-button">Отправить</button>
                </form>
            </div>
        @else
            <p class="guest-message">Только авторизованные пользователи могут оставлять комментарии.</p>
        @endauth
    </div>
@endsection
