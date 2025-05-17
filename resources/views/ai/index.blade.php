@extends('layouts.layout')
@section('title', 'LibraryAI')
@section('content')
    <div class="search-and-filter">
        <form action="{{ route('ai.index') }}" method="GET" autocomplete="off">
            <input type="text" name="search" placeholder="Поиск по названию и описанию..." value="{{ request('search') }}">
            <select class="select" name="transformation" id="transformation">
                <option value="">Все преобразования</option>
                @foreach ($transformations as $t)
                    <option value="{{ $t->id }}" {{ request('transformation') == $t->id ? 'selected' : '' }}>
                        {{ $t->name }}
                    </option>
                @endforeach
            </select>
            <select class="select" name="task" id="task">
                <option value="">Все задачи</option>
                @foreach ($tasks as $task)
                    <option value="{{ $task->id }}" {{ request('task') == $task->id ? 'selected' : '' }}>
                        {{ $task->name }}
                    </option>
                @endforeach
            </select>
            <button class="articles-button" type="submit">Найти</button>
        </form>
        @auth
            <a href="{{route('ai.create')}}" class="btn-create">Добавить AI</a>
            <div class="tooltip-container">
                <svg width="25px" height="25px" class="tooltip-container">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                          d="M12 2.75C6.89137 2.75 2.75 6.89137 2.75 12C2.75 17.1086 6.89137 21.25 12 21.25C17.1086 21.25 21.25 17.1086 21.25 12C21.25 6.89137 17.1086 2.75 12 2.75ZM1.25 12C1.25 6.06294 6.06294 1.25 12 1.25C17.9371 1.25 22.75 6.06294 22.75 12C22.75 17.9371 17.9371 22.75 12 22.75C6.06294 22.75 1.25 17.9371 1.25 12ZM12 7.75C11.3787 7.75 10.875 8.25368 10.875 8.875C10.875 9.28921 10.5392 9.625 10.125 9.625C9.71079 9.625 9.375 9.28921 9.375 8.875C9.375 7.42525 10.5503 6.25 12 6.25C13.4497 6.25 14.625 7.42525 14.625 8.875C14.625 9.83834 14.1056 10.6796 13.3353 11.1354C13.1385 11.2518 12.9761 11.3789 12.8703 11.5036C12.7675 11.6246 12.75 11.7036 12.75 11.75V13C12.75 13.4142 12.4142 13.75 12 13.75C11.5858 13.75 11.25 13.4142 11.25 13V11.75C11.25 11.2441 11.4715 10.8336 11.7266 10.533C11.9786 10.236 12.2929 10.0092 12.5715 9.84439C12.9044 9.64739 13.125 9.28655 13.125 8.875C13.125 8.25368 12.6213 7.75 12 7.75ZM12 17C12.5523 17 13 16.5523 13 16C13 15.4477 12.5523 15 12 15C11.4477 15 11 15.4477 11 16C11 16.5523 11.4477 17 12 17Z" fill="#FFFFFF"/>
                </svg>
                <span class="tooltip-text">Расскажите другим о новом AI! Вы также поможете нам!</span>
            </div>
        @endauth
    </div>
    <div class="ai-container">
        @if($ais->isEmpty())
            <h2>По вашему запросу ничего не найдено:(</h2>
        @else
            @foreach ($ais as $ai)
                <div class="ai-card">
                    <div class="ai-card-img">
                        <img src="/public/assets/images/ai.png" alt="photo">
                    </div>
                    <div class="ai-card-name">
                        <span>{{ $ai->name }}</span>
                    </div>
                    <div class="ai-card-description">
                        <p>
                            {{Str::words(strip_tags($ai->description), 30, '...') }}
                        </p>
                    </div>
                    <div class="ai-card-transformations-tasks">
                        @foreach ($ai->transformations as $transformation)
                            <span>{{ $transformation->name }}</span>
                        @endforeach
                    </div>
                    <div class="ai-card-transformations-tasks">
                        @foreach ($ai->tasks as $task)
                            <span>{{ $task->name }}</span>
                        @endforeach
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@endsection
