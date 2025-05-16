@extends('layouts.layout')
@section('title', 'LibraryAI')
@section('content')
    <div class="search-and-filter">
        <form action="{{ route('ai.index') }}" method="GET" autocomplete="off">
            <input type="text" name="search" placeholder="Поиск по названию и описанию..." value="{{ request('search') }}">
            <select class="select" name="transformation" id="transformation">
                <option value="">Все преобразование</option>
                @foreach ($transformations as $transformation)
                    <option value="{{ $transformation->id }}" {{ request('transformation') == $transformation->id ? 'selected' : '' }}>
                        {{ $transformation->name }}
                    </option>
                @endforeach
            </select>
            <button class="articles-button" type="submit">Найти</button>
        </form>
    </div>
    @if($ais->isEmpty())
        <p style="text-align: center; margin-top: 20px;">По вашему запросу ничего не найдено:(</p>
    @else
        @foreach ($ais as $ai)
            <div style="border: 1px solid black; margin-bottom: 20px; padding: 10px;">
                <p><strong>{{ $ai->name }}</strong></p>
                <p>{{ $ai->description }}</p>
                @if ($ai->transformations->isNotEmpty())
                    <ul>
                        @foreach ($ai->transformations as $transformation)
                            <li>{{ $transformation->name }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        @endforeach
    @endif
@endsection
