@extends('layouts.layout')
@section('title', 'LibraryAI')
@section('content')
    <section class="auth-container">
        <h2 class="auth-title">Вх0д</h2>
        @error('error')
        <p class="auth-warning">{{ $message }}</p>
        @enderror

        <form action="{{ route('login') }}" method="post" class="auth-form" autocomplete="off">
            @csrf
            <div class="auth-field">
                <label for="auth-email">Электронная почта</label>
                <input id="auth-email" type="email" name="email" required placeholder="Введите почту" class="auth-input" />
            </div>
            <div class="auth-field">
                <label for="auth-password">Пароль</label>
                <input id="auth-password" type="password" name="password" required placeholder="Введите пароль" class="auth-input" />
            </div>
            <div class="auth-button-wrapper">
                <button type="submit" class="auth-button">В0йти</button>
            </div>
        </form>
        <a href="{{ route('register') }}" class="auth-link">Нет аккаунта? Регистрация</a>
    </section>
@endsection
