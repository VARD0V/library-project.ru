@extends('layouts.layout')
@section('title', 'Вход')
@section('content')
    <section class="log-in">
        <h2>Вход</h2>
        @error('error')
        <p class="warning">{{ $message }}</p>
        @enderror
        <form action="{{route('login')}}" method="post" enctype="application/x-www-form-urlencoded">
            @csrf
            <div>
                <label for="log-in-email">Электронная почта</label>
                <input id="log-in-email" type="email" name="email" required placeholder="Введите почту"/>
            </div>
            <div>
                <label for="log-in-password">Пароль</label>
                <input id="log-in-password" type="password" name="password" required placeholder="Введите пароль"/>
            </div>
            <div>
                <button type="submit">Войти</button>
            </div>
        </form>
    </section>
    <a href="{{ route('register') }}">Регистрация</a>
@endsection

