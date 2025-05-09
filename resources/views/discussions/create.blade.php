@extends('layouts.layout')
@section('title', 'Создание обсуждения')

@section('content')
    <h1>Создать обсуждение</h1>

    <form action="{{ route('discussions.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label>Название</label><br>
        <input type="text" name="title" value="{{ old('title') }}" required><br>

        <label>Описание</label><br>
        <input type="text" name="description" value="{{ old('description') }}"><br>
        <label>Статус</label><br>
        <input type="text" name="status" value="{{ old('status') }}"><br>
        <label>Категория</label><br>
        <select name="discussion_category_id" required>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select><br>

        <label>Текст</label><br>
        <textarea name="text" rows="5" required>{{ old('text') }}</textarea><br>

        <label>Превью (необязательно)</label><br>
        <input type="file" name="preview"><br><br>

        <button type="submit">Создать</button>
    </form>

    <a href="{{ route('discussions.index') }}">← Назад</a>
@endsection
