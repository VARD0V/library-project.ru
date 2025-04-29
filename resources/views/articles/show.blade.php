@extends('layouts.layout')
@section('title', 'LibraryAI')
@section('content')
    <h1>{{ $article->title }}</h1>
    <p><strong>Категория:</strong> {{ $article->articleCategory->name }}</p>
    <p><strong>Описание:</strong> {{ $article->description }}</p>
    <p><strong>Текст:</strong> {{ $article->text }}</p>
    @if($article->preview)
        <img src="{{ asset('storage/' . $article->preview) }}" alt="Превью" style="max-width: 400px;">
    @endif
    <a href="{{ route('articles.index') }}" class="btn btn-secondary mt-3">Назад к списку</a>
@endsection
