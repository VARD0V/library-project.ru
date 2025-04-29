@extends('layouts.layout')

@section('title', $ai->name)

@section('content')
    <h1>{{ $ai->name }}</h1>

    <p><strong>Платный доступ:</strong> {{ $ai->paid ? 'Да' : 'Нет' }}</p>
    <p><strong>Пробный период:</strong> {{ $ai->trial }}</p>

    @if($ai->conversion_from && $ai->conversion_to)
        <p><strong>Конвертация:</strong> {{ $ai->conversion_from }} → {{ $ai->conversion_to }}</p>
    @elseif($ai->conversion_from || $ai->conversion_to)
        <p><strong>Конвертация:</strong>
            {{ $ai->conversion_from ?? '—' }} → {{ $ai->conversion_to ?? '—' }}
        </p>
    @else
        <p><strong>Конвертация:</strong> Нет данных</p>
    @endif

    <p><strong>Задачи:</strong></p>
    @if($ai->tasks->isEmpty())
        <p>Нет связанных задач</p>
    @else
        <ul>
            @foreach($ai->tasks as $task)
                <li>{{ $task->name }}</li>
            @endforeach
        </ul>
    @endif

    <a href="{{ route('ai.index') }}">Назад к списку</a>
@endsection
