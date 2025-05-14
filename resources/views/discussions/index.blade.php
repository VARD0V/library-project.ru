@extends('layouts.layout')
@section('title', 'LibraryAI')
@section('content')
    <div class="search-and-filter">
        <form action="{{ route('discussions.index') }}" method="GET" autocomplete="off">
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
    </div>
    <div class="discussions-container">
        @foreach($discussions as $discussion)
            <a href="{{ route('discussions.show', $discussion) }}" class="discussion-card-link">
                <div class="discussion-card">
                    <h1>{{ $discussion->title }}</h1>
                    <div class="meta">
                        <span class="category">{{ $discussion->discussionCategory?->name }}</span>
                        <span class="author">{{ $discussion->author?->login }}</span>
                    </div>
                    <p class="description">{{ $discussion->description }}</p>
                    <div class="status">
                        Статус: {{ $discussion->status }}
                    </div>
                </div>
            </a>
        @endforeach
    </div>
@endsection
