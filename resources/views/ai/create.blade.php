@extends('layouts.layout')

@section('content')
    <h1>Создание нового ИИ</h1>

    <form action="{{ route('ai.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Название ИИ</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        <div class="form-group">
            <label for="conversion_from">Преобразование из</label>
            <input type="text" name="conversion_from" id="conversion_from" class="form-control" value="{{ old('conversion_from') }}" required>
        </div>

        <div class="form-group">
            <label for="conversion_to">Преобразование в</label>
            <input type="text" name="conversion_to" id="conversion_to" class="form-control" value="{{ old('conversion_to') }}" required>
        </div>

        <div class="form-group">
            <label for="paid">Платный</label>
            <select name="paid" id="paid" class="form-control" required>
                <option value="1" {{ old('paid') == 1 ? 'selected' : '' }}>Да</option>
                <option value="0" {{ old('paid') == 0 ? 'selected' : '' }}>Нет</option>
            </select>
        </div>

        <div class="form-group">
            <label for="trial">Пробный период</label>
            <select name="trial" id="trial" class="form-control" required>
                <option value="1" {{ old('trial') == 1 ? 'selected' : '' }}>Да</option>
                <option value="0" {{ old('trial') == 0 ? 'selected' : '' }}>Нет</option>
            </select>
        </div>

        <div class="form-group">
            <label for="tasks">Задачи</label>
            @foreach ($tasks as $task)
                <div>
                    <input type="checkbox" name="tasks[]" id="task_{{ $task->id }}" value="{{ $task->id }}">
                    <label for="task_{{ $task->id }}">{{ $task->name }}</label>
                </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-primary">Создать</button>
    </form>
@endsection
