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
                    <label class="create-label" for="trial">Описание триала:</label><br>
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

@endsection
