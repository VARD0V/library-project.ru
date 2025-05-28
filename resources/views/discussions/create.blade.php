@extends('layouts.layout')
@section('title', 'Создание обсуждения')
@section('content')
    <div class="create-container">
        <h1>Создать обсуждение | задайте интересующий вопрос и вам ответят!</h1>
    </div>
    <div class="create-container">
        <form style="display: flex; flex-direction: column; gap: 10px" action="{{ route('discussions.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="create-div">
                <div>
                    <label class="create-label">Название:</label>
                    <input class="text-input" type="text" name="title" value="{{ old('title') }}" required>
                </div>
                <div>
                    <label class="create-label">Категория:</label>
                    <select class="select" name="discussion_category_id" required>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div>
                <label class="create-label">Превью (необязательно):</label>
                <input class="file-input" type="file" name="preview">
            </div>
            <div>
                <label class="create-label">Описание:</label>
                <textarea class="comment-input" name="description" rows="3">{{ old('description') }}</textarea>
            </div>
            <div>
                <label class="create-label">Текст:</label>
                <textarea class="comment-input" name="text" rows="5" required>{{ old('text') }}</textarea>
            </div>
            <button class="articles-button" type="submit">Создать</button>
            @if ($errors->any())
                <div class="alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </form>
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
