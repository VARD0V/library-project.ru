@extends('layouts.layout')
@section('title', 'LibraryAI')
@section('content')
    <section class="profile" style="padding: 20px; max-width: 600px; margin: 0 auto;">
        <h2>Личный кабинет</h2>
            <!-- Если пользователь авторизован, показываем профиль -->
            <h3>Профиль пользователя</h3>

            <div style="margin-bottom: 20px;">
                @if(auth()->user()->avatar_url)
                    <img src="{{ asset('storage/' . auth()->user()->avatar_url) }}" alt="Аватар"
                         style="width: 120px; height: 120px; object-fit: cover; border-radius: 50%;">
                @else
                    <p>Аватар не загружен</p>
                @endif
            </div>

            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data"
                  style="display: flex; flex-direction: column; gap: 10px;">
                @csrf
                @method('PUT')

                <div>
                    <label for="profile-login">Логин</label>
                    <input type="text" id="profile-login" name="login" value="{{ old('login', auth()->user()->login) }}" required>
                    @error('login')
                    <p class="warning">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="profile-email">Email</label>
                    <input type="email" id="profile-email" name="email" value="{{ old('email', auth()->user()->email) }}" required>
                    @error('email')
                    <p class="warning">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="profile-birthday">День рождения</label>
                    <input type="date" id="profile-birthday" name="birthday" value="{{ old('birthday', auth()->user()->birthday) }}" required>
                    @error('birthday')
                    <p class="warning">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="profile-avatar">Новый аватар</label>
                    <input type="file" name="avatar_url" id="profile-avatar_url" accept="image/jpeg,image/png,image">
                    @error('avatar_url')
                    <p class="warning">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Поля для изменения пароля -->
                <div>
                    <label for="profile-password">Новый пароль</label>
                    <input type="password" name="password" id="profile-password" placeholder="Введите новый пароль">
                    @error('password')
                    <p class="warning">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="profile-password_confirmation">Подтвердите новый пароль</label>
                    <input type="password" name="password_confirmation" id="profile-password_confirmation" placeholder="Подтвердите новый пароль">
                    @error('password_confirmation')
                    <p class="warning">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit">Сохранить изменения</button>
            </form>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit">Выйти</button>
            </form>
    </section>
@endsection
