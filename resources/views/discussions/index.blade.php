@extends('layouts.layout')

@section('content')
    <h1>Список обсуждений</h1>

    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Заголовок</th>
            <th>Категория</th>
            <th>Автор</th>
            <th>Дата создания</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($discussions as $discussion)
            <tr>
                <td>{{ $discussion->id }}</td>
                <td>{{ $discussion->title }}</td>
                <td>{{ $discussion->discussionCategory?->name ?? 'Без категории' }}</td>
                <td>{{ $discussion->author?->login ?? 'Неизвестный автор' }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
