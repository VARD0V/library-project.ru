@extends('layouts.layout')
@section('title', 'Редактировать ИИ')
@section('content')
        <div class="create-container">
            <h1>Редактировать ИИ: {{ $ai->name }}</h1>
        </div>
        <div class="create-container">
            <form style="display: flex; flex-direction: column; gap: 10px" method="POST" action="{{ route('ai.update', $ai) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="create-div">
                    <div>
                        <label class="create-label" for="name">Название</label>
                        <input class="text-input" type="text" name="name" id="name" value="{{ old('name', $ai->name) }}" required>
                    </div>
                    <div>
                        <label class="create-label" for="paid">Платный?</label>
                        <select class="select" name="paid" id="paid" required>
                            <option value="1" {{ old('paid', $ai->paid) == 1 ? 'selected' : '' }}>Да</option>
                            <option value="0" {{ old('paid', $ai->paid) == 0 ? 'selected' : '' }}>Нет</option>
                        </select>
                    </div>
                    <div>
                        <label class="create-label" for="trial">Пробный период</label>
                        <input class="text-input" type="number" name="trial" id="trial" value="{{ old('trial', $ai->trial) }}">
                    </div>
                    <div>
                        <label class="create-label" for="link">Ссылка</label>
                        <input class="text-input" type="url" name="link" id="link" value="{{ old('link', $ai->link) }}">
                    </div>
                </div>
                <div>
                    <label class="create-label" for="description">Описание</label>
                    <textarea class="comment-input" name="description" id="description" rows="4">{{ old('description', $ai->description) }}</textarea>
                </div>
                <div class="create-div">
                    <div style="display: flex; align-items: center; gap: 20px">
                        <label class="create-label" for="tasks">Задачи</label>
                        <select class="select-ai" name="task_ids[]" id="tasks" multiple>
                            @foreach($tasks as $task)
                                <option value="{{ $task->id }}" {{ in_array($task->id, old('task_ids', $ai->tasks->pluck('id')->toArray())) ? 'selected' : '' }}>
                                    {{ $task->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div style="display: flex; align-items: center; gap: 20px">
                        <label class="create-label" for="transformations">Преобразования</label>
                        <select class="select-ai" name="transformation_ids[]" id="transformations" multiple>
                            @foreach($transformations as $transformation)
                                <option value="{{ $transformation->id }}" {{ in_array($transformation->id, old('transformation_ids', $ai->transformations->pluck('id')->toArray())) ? 'selected' : '' }}>
                                    {{ $transformation->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @if ($errors->any())
                    <div class="warning">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div style="margin-top: 20px; display: flex; justify-content: center; align-items: center; gap: 20px">
                    <button class="articles-button" type="submit">Сохранить изменения</button>
                    <a class="btn-edit" href="{{ route('ai.show', $ai) }}">Отмена</a>
                </div>
            </form>
        </div>
@endsection
