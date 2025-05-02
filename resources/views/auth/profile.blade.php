@extends('layouts.layout')
@section('title', 'LibraryAI')
@section('content')
    <section id="profile-section">
        <p id="profile-title">Личный кабинет</p>

        <div id="avatar-block">
            @if(auth()->user()->avatar_url)
                <img src="{{ asset('storage/' . auth()->user()->avatar_url) }}" alt="Аватар" id="profile-avatar">
            @else
                <p>Аватар не загружен</p>
            @endif
        </div>

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" id="profile-form">
            @csrf
            @method('PUT')

            <div>
                <label for="profile-login">Логин</label>
                <input class="input-universal" type="text" id="profile-login" name="login" value="{{ old('login', auth()->user()->login) }}" required>
                @error('login')
                <p>{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="profile-email">Email</label>
                <input type="email" id="profile-email" name="email" value="{{ old('email', auth()->user()->email) }}" required>
                @error('email')
                <p>{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="profile-birthday">День рождения</label>
                <input type="date" id="profile-birthday" name="birthday" value="{{ old('birthday', auth()->user()->birthday) }}" required>
                @error('birthday')
                <p>{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="profile-avatar_url">Новый аватар</label>
                <input type="file" name="avatar_url" id="profile-avatar_url" accept="image/jpeg,image/png,image">
                @error('avatar_url')
                <p>{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="profile-password">Новый пароль</label>
                <input type="password" name="password" id="profile-password" placeholder="Введите новый пароль">
                @error('password')
                <p>{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="profile-password_confirmation">Подтвердите новый пароль</label>
                <input type="password" name="password_confirmation" id="profile-password_confirmation" placeholder="Подтвердите новый пароль">
                @error('password_confirmation')
                <p>{{ $message }}</p>
                @enderror
            </div>

            <button class="btn-universal" type="submit" id="save-button">Сохранить изменения</button>
        </form>

        <form action="{{ route('logout') }}" method="POST" id="logout-form">
            @csrf
            <button class="btn-universal" type="submit" id="logout-button">Выйти</button>
        </form>
    </section>
@endsection
