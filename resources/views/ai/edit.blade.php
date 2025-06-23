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
                        <input class="text-input" min="0"  type="number" name="trial" id="trial" value="{{ old('trial', $ai->trial) }}">
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
