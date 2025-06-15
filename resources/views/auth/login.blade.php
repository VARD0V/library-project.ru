@extends('layouts.layout')
@section('title', 'LibraryAI | Вход')
@section('content')
    <section class="auth-container">
        <h2 class="auth-title">Вход</h2>
        <form action="{{ route('login') }}" method="post" class="auth-form" autocomplete="off">
            @csrf
            <div class="auth-field">
                <label for="auth-email">Электронная почта</label>
                <input id="auth-email" type="email" name="email" required placeholder="Введите почту" class="auth-input" value="{{ old('email') }}" />
            </div>
            <div class="auth-field">
                <label for="auth-password">Пароль</label>
                <input id="auth-password" type="password" name="password" required placeholder="Введите пароль" class="auth-input" />
            </div>
            <div class="auth-button-wrapper">
                <button type="submit" class="auth-button">В0йти</button>
            </div>
            @if($errors->any())
                <div class="auth-warning">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </form>
        <a href="{{ route('register') }}" class="auth-link">Нет аккаунта? Регистрация</a>
    </section>
@endsection
