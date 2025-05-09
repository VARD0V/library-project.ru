@extends('layouts.layout')
@section('title', 'LibraryAI')
@section('content')
    <h1>Список обсуждений</h1>
    <a href="{{ route('discussions.create') }}">создать</a>
    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Заголовок</th>
            <th>Статус</th>
            <th>Категория</th>
            <th>Автор</th>
            <th>Посмотреть</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($discussions as $discussion)
            <tr>
                <td>{{ $discussion->id }}</td>
                <td>{{ $discussion->title }}</td>
                <td>{{ $discussion->status }}</td>
                <td>{{ $discussion->discussionCategory?->name ?? 'Без категории' }}</td>
                <td>{{ $discussion->author?->login ?? 'Неизвестный автор' }}</td>
                <td><a href="{{ route('discussions.show', $discussion) }}">Просмотр</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
