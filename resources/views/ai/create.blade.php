@extends('layouts.layout')
@section('title', 'Добавить новый ИИ')
@section('content')

    <div class="create-container">
        <h1>Добавить новый ИИ</h1>
    </div>

    <div class="create-container">
        <form style="display: flex; flex-direction: column; gap: 15px" action="{{ route('ai.store') }}" method="POST">
            @csrf
            <div class="ai-create-container">
                <div>
                    <label class="create-label" for="name">Название:</label><br>
                    <input class="text-input" type="text" name="name" id="name" value="{{ old('name') }}" required>
                    @error('name')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label class="create-label" for="trial">Пробный период:</label><br>
                    <input class="text-input" type="text" name="trial" id="trial" value="{{ old('trial') }}">
                    @error('trial')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label class="create-label" for="link">Ссылка:</label><br>
                    <input class="text-input" type="url" name="link" id="link" value="{{ old('link') }}" required>
                    @error('link')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label>
                        <input type="checkbox" name="paid" value="1" {{ old('paid') ? 'checked' : '' }}>
                        Платный
                    </label>
                </div>
            </div>
            <div>
                <label class="create-label" for="description">Описание:</label><br>
                <textarea class="comment-input" name="description" id="description" rows="4">{{ old('description') }}</textarea>
                @error('description')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="ai-create-container">
                <div>
                    <label class="create-label" for="task_ids">Задачи:</label><br>
                    <select class="select" name="task_ids[]" id="task_ids" multiple>
                        @foreach ($tasks as $task)
                            <option value="{{ $task->id }}" {{ in_array($task->id, old('task_ids', [])) ? 'selected' : '' }}>
                                {{ $task->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('task_ids')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label class="create-label" for="transformation_ids">Преобразования:</label><br>
                    <select class="select" name="transformation_ids[]" id="transformation_ids" multiple>
                        @foreach ($transformations as $transformation)
                            <option value="{{ $transformation->id }}" {{ in_array($transformation->id, old('transformation_ids', [])) ? 'selected' : '' }}>
                                {{ $transformation->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('transformation_ids')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <button class="articles-button" type="submit">Сохранить</button>
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
