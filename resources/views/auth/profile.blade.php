@extends('layouts.layout')

@section('title', 'Профиль')

@section('content')
    <section class="profile" style="padding: 20px; max-width: 600px; margin: 0 auto;">
        <h2>Профиль пользователя</h2>

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
                <input type="file" name="avatar" id="profile-avatar" accept="image/jpeg,image/png,image/svg+xml">
                @error('avatar')
                <p class="warning">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit">Сохранить изменения</button>
        </form>
    </section>
@endsection
