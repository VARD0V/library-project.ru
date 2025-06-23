@extends('layouts.layout')
@section('title', 'LibraryAI')
@section('content')
    <div class="ai-containerAI">
        <div class="ai-container-title">
            <h1>{{ $ai->name }}</h1>
        </div>
        <div class="ai-info-container">
            <div class="ai-info-text">
                <span>Платное: {{ $ai->paid === 1 ? 'Да' : 'Нет' }}</span>
                <span>Бесплатный период: {{ $ai->trial !== null ? $ai->trial . ' дней' : '-' }}</span>
                <span>Ссылка: <a href="{{ $ai->link }}">{{ $ai->link }}</a></span>
            </div>
            <div class="ai-image-container">
                <img src="/public/assets/images/ai.png" alt="AI Image" class="ai-image">
            </div>
        </div>

        <div class="ai-description">
            <span style="font-size: 20px">Описание:</span>
            <p>{{ $ai->description }}</p>
        </div>

        <div class="ai-features-container">
            <span style="font-size: 20px">Преобразования:</span>
            <div class="ai-card-transformations-tasks">
                @foreach ($ai->transformations as $transformation)
                    <span class="ai-tag">{{ $transformation->name }}</span>
                @endforeach
            </div>
            <span style="font-size: 20px">Задачи:</span>
            <div class="ai-card-transformations-tasks">
                @foreach ($ai->tasks as $task)
                    <span class="ai-tag">{{ $task->name }}</span>
                @endforeach
            </div>
        </div>
        <div style="display: flex; gap: 10px">
            @can('update', $ai)
                <div class="ai-actions">
                    <a href="{{ route('ai.edit', $ai) }}"><button class="btn-edit">Редактировать</button></a>
                </div>
            @endcan
            @can('delete', $ai)
                <form action="{{ route('ai.destroy', $ai) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-delete" onclick="return confirm('Удалить ИИ?')">Удалить</button>
                </form>
            @endcan
        </div>
    </div>
    <div class="back-btn">
        <a href="{{ route('ai.index') }}">
            <svg height="50px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M9 22H15C20 22 22 20 22 15V9C22 4 20 2 15 2H9C4 2 2 4 2 9V15C2 20 4 22 9 22Z" stroke="#212121" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M9.00002 15.3802H13.92C15.62 15.3802 17 14.0002 17 12.3002C17 10.6002 15.62 9.22021 13.92 9.22021H7.15002" stroke="#212121" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M8.57 10.7701L7 9.19012L8.57 7.62012" stroke="#212121" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </a>
    </div>
@endsection
