@extends('layouts.layout')
@section('title', 'LibraryAI')
@section('content')
    <h1>Список искусственных интеллектов</h1>

    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Название ИИ</th>
            <th>Задачи</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($ais as $ai)
            <tr>
                <td>{{ $ai->id }}</td>
                <td>{{ $ai->name }}</td>
                <td>
                    @if ($ai->tasks->isNotEmpty())
                        <ul>
                            @foreach ($ai->tasks as $task)
                                <li>{{ $task->name }}</li>
                            @endforeach
                        </ul>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
