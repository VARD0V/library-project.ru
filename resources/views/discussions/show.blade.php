@extends('layouts.layout')
@section('title', $discussion->title)
@section('content')

    <div class="discussion-container">
        <div class="discussion-header">
            <h1>{{ $discussion->title }}</h1>
            @can('delete', $discussion)
                <div>
                    <form action="{{ route('discussions.destroy', $discussion) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn-delete" type="submit" onclick="return confirm('Вы уверены, что хотите удалить обсуждение?')">Удалить обсуждение</button>
                    </form>
                </div>
            @endcan
            <div class="meta-info">
                @if($discussion->discussionCategory)
                    <span class="category">{{ $discussion->discussionCategory->name }}</span>
                @endif
                <span class="divider">|</span>
                @if($discussion->author)
                    <span class="author">{{ $discussion->author->login }}</span>
                @endif
            </div>

            <div class="status-box">
                <!-- Статус -->
                <span class="status-text">Статус: {{ $discussion->status === 1 ? 'Активно' : 'Не активно' }}</span>

                <!-- Форма редактирования статуса (если активирована) -->
                @if(session('edit_discussion_id') == $discussion->id)
                    <form action="{{ route('discussions.update', $discussion) }}" method="POST" class="inline-form">
                        @csrf
                        @method('PUT')
                        <input type="text" name="status" value="{{ old('status', $discussion->status) }}" required class="status-input">
                        <button type="submit" class="btn-edit-status">Сохранить</button>
                        <a href="{{ url()->current() }}" class="btn-cancel">Отмена</a>
                    </form>
                @else
                    <!-- Кнопка редактирования -->
                    @can('update', $discussion)
                        <form action="{{ route('discussions.edit', $discussion) }}" method="GET" class="inline-form">
                            <button type="submit" class="btn-edit-status">Редактировать</button>
                        </form>
                    @endcan
                @endif
            </div>
        </div>

        <div class="discussion-content">
            <!-- Превью -->
            @if($discussion->preview)
                <div class="preview-image">
                    <img src="{{ asset('storage/' . $discussion->preview) }}" alt="Превью">
                </div>
            @endif

            <!-- Текст обсуждения -->
            <div class="text-section">
                <p><strong>Описание:</strong> {{ $discussion->description }}</p>
                <p><strong>Текст:</strong> {{ $discussion->text }}</p>
            </div>
        </div>
    </div>
    <!-- Блок комментариев -->
    <div class="comments-container">
        <h2>Чат</h2>
        @if($discussion->comments->count())
            <ul class="comments-list">
                @foreach($discussion->comments as $comment)
                    <li class="comment-item">
                        <div class="comment-header">
                            @if($comment->user->avatar_url && file_exists(public_path('storage/' . $comment->user->avatar_url)))
                                <img src="{{ asset('storage/' . $comment->user->avatar_url) }}" alt="Аватар" class="avatar">
                            @else
                                <img src="{{ asset('assets/images/anonim.jpg') }}" alt="Аватар" class="avatar">
                            @endif
                            <div class="user-info">
                                <strong>{{ $comment->user->login }}:</strong>
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
                    <input type="hidden" name="discussion_id" value="{{ $discussion->id }}">
                    <button type="submit" class="comments-button">Отправить</button>
                </form>
            </div>
        @else
            <p class="guest-message">Только авторизованные пользователи могут оставлять комментарии.</p>
        @endauth
    </div>

    <div class="back-btn">
        <a href="{{ route('discussions.index') }}">
            <svg height="50px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M9 22H15C20 22 22 20 22 15V9C22 4 20 2 15 2H9C4 2 2 4 2 9V15C2 20 4 22 9 22Z" stroke="#212121" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M9.00002 15.3802H13.92C15.62 15.3802 17 14.0002 17 12.3002C17 10.6002 15.62 9.22021 13.92 9.22021H7.15002" stroke="#212121" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M8.57 10.7701L7 9.19012L8.57 7.62012" stroke="#212121" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </a>
    </div>

@endsection
