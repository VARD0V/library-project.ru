@extends('layouts.layout')

@section('title', 'Регистрация')

@section('content')
    <section class="log-in" style="padding: 20px">
        <h2>Зарегаться</h2>
        <form action="{{ route('register') }}" method="post" enctype="multipart/form-data" style="display: flex; flex-direction: column; gap: 10px">
            @csrf
            <div>
                <label for="register-birthday">День рождения *</label>
                <input type="date" id="register-birthday" name="birthday" required />
                @error('birthday')
                <p class="warning">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="register-email">Почта *</label>
                <input type="email" id="register-email" name="email" required placeholder="Введите email" />
                @error('email')
                <p class="warning">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="register-login">Логин *</label>
                <input type="text" id="register-login" name="login" required placeholder="Введите login" />
                @error('login')
                <p class="warning">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="register-password">Пароль *</label>
                <input type="password" id="register-password" name="password" required placeholder="Введите password" />
                @error('password')
                <p class="warning">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="register-avatar">Аватар</label>
                <input id="register-avatar" type="file" name="avatar" accept="image/jpeg,image/png,image/svg+xml" />
                @error('avatar')
                <p class="warning">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <button type="submit">Зарегаться</button>
            </div>
        </form>
    </section>
@endsection
