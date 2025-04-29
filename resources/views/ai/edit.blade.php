@extends('layouts.layout')

@section('title', 'Редактировать ИИ')

@section('content')
    <section class="ai-edit">
        <h2>Редактировать ИИ: {{ $ai->name }}</h2>

        @if ($errors->any())
            <div class="warning">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('ai.update', $ai) }}">
            @csrf
            @method('PUT')

            <div>
                <label for="name">Название</label>
                <input type="text" name="name" id="name" value="{{ old('name', $ai->name) }}" required>
            </div>

            <div>
                <label for="paid">Платный?</label>
                <select name="paid" id="paid" required>
                    <option value="1" {{ old('paid', $ai->paid) == 1 ? 'selected' : '' }}>Да</option>
                    <option value="0" {{ old('paid', $ai->paid) == 0 ? 'selected' : '' }}>Нет</option>
                </select>
            </div>

            <div>
                <label for="trial">Пробный период</label>
                <select name="trial" id="trial" required>
                    <option value="1" {{ old('trial', $ai->trial) == 1 ? 'selected' : '' }}>Да</option>
                    <option value="0" {{ old('trial', $ai->trial) == 0 ? 'selected' : '' }}>Нет</option>
                </select>
            </div>

            <div>
                <label for="conversion_from">Преобразование из</label>
                <input type="text" name="conversion_from" id="conversion_from"
                       value="{{ old('conversion_from', $ai->conversion_from) }}">
            </div>

            <div>
                <label for="conversion_to">Преобразование в</label>
                <input type="text" name="conversion_to" id="conversion_to"
                       value="{{ old('conversion_to', $ai->conversion_to) }}">
            </div>

            <div>
                <label for="tasks">Задачи</label>
                <select name="tasks[]" id="tasks" multiple>
                    @foreach($tasks as $task)
                        <option value="{{ $task->id }}" {{ $ai->tasks->contains($task->id) ? 'selected' : '' }}>
                            {{ $task->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <button type="submit">Сохранить изменения</button>
                <a href="{{ route('ai.index') }}">Отмена</a>
            </div>
        </form>
    </section>
@endsection
