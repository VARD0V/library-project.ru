@extends('layouts.layout')

@section('content')
    <h1>Список статей</h1>

    @can('create', App\Models\Article::class)
        <a href="{{ route('articles.create') }}">Создать новую статью</a>
    @endcan

    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Заголовок</th>
            <th>Категория</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($articles as $article)
            <tr>
                <td>{{ $article->id }}</td>
                <td>{{ $article->title }}</td>
                <td>{{ $article->articleCategory->name }}</td>
                <td>
                    <a href="{{ route('articles.show', $article) }}">Просмотр</a>

                    @can('update', $article)
                        <a href="{{ route('articles.edit', $article) }}">Редактировать</a>
                    @endcan

                    @can('delete', $article)
                        <form action="{{ route('articles.destroy', $article) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Удалить</button>
                        </form>
                    @endcan
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
