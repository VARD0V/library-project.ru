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
                    <label class="create-label">Статус:</label>
                    <input class="text-input" type="text" name="status" value="{{ old('status') }}">
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
        </form>
    </div>
@endsection
