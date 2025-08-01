@extends('layouts.layout')
@section('title', 'LibraryAI | Регистрация')
@section('content')
    <section class="auth-container">
        <h2 class="auth-title">Регистрация</h2>
        <form action="{{ route('register') }}" method="post" enctype="multipart/form-data" class="auth-form" autocomplete="off">
            @csrf
            <div class="auth-field">
                <label for="register-birthday">День рождения *</label>
                <input type="date" id="register-birthday" name="birthday" required class="auth-input" value="{{ old('birthday') }}" />
            </div>
            <div class="auth-field">
                <label for="register-email">Почта *</label>
                <input type="email" id="register-email" name="email" required placeholder="Введите email" class="auth-input" value="{{ old('email') }}" />
            </div>
            <div class="auth-field">
                <label for="register-login">Логин *</label>
                <input type="text" id="register-login" name="login" required placeholder="Введите login" class="auth-input" value="{{ old('login') }}" />
            </div>
            <div class="auth-field">
                <label for="register-password">Пароль *</label>
                <input type="password" id="register-password" name="password" required placeholder="Введите password" class="auth-input" />
            </div>
            <div class="auth-field">
                <label for="register-avatar">Аватар</label>
                <input id="register-avatar" type="file" name="avatar_url" accept="image/jpeg,image/png,image/jpg" class="auth-input" />
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
            <div class="auth-button-wrapper">
                <button type="submit" class="auth-button">Зарегистрир0ваться</button>
            </div>
        </form>
        <a href="{{ route('login') }}" class="auth-link">Есть аккаунт? Вход</a>
    </section>
@endsection
