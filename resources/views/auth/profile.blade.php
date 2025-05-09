@extends('layouts.layout')
@section('title', 'LibraryAI')
@section('content')
    <section class="profile-page-wrapper">
        <div class="profile-page-container">
            <p class="profile-page-title">Личный кабинет</p>
            <div class="profile-page-main">
                <div class="profile-page-avatar-block">
                    @if(auth()->user()->avatar_url)
                        <img src="{{ asset('storage/' . auth()->user()->avatar_url) }}" alt="Аватар" class="profile-page-avatar">
                    @else
                        <p>Аватар не загружен</p>
                    @endif
                </div>
                <div class="profile-page-info-block">
                    <!-- Форма редактирования -->
                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" id="profile-form" class="profile-page-form hidden">
                        @csrf
                        @method('PUT')

                        <!-- Логин -->
                        <div class="profile-page-field">
                            <label for="profile-login">Логин</label>
                            <input class="profile-page-input" type="text" id="profile-login" name="login"
                                   value="{{ old('login', auth()->user()->login) }}" required>
                            @error('login')
                            <p>{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Почта -->
                        <div class="profile-page-field">
                            <label for="profile-email">Email</label>
                            <input class="profile-page-input" type="email" id="profile-email" name="email"
                                   value="{{ old('email', auth()->user()->email) }}" required>
                            @error('email')
                            <p>{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Дата рождения -->
                        <div class="profile-page-field">
                            <label for="profile-birthday">День рождения</label>
                            <input class="profile-page-input" type="date" id="profile-birthday" name="birthday"
                                   value="{{ old('birthday', auth()->user()->birthday) }}" required>
                            @error('birthday')
                            <p>{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Новый аватар -->
                        <div class="profile-page-field">
                            <label for="profile-avatar_url">Новый аватар</label>
                            <input type="file" name="avatar_url" id="profile-avatar_url" accept="image/jpeg,image/png,image" class="profile-page-input">
                            @error('avatar_url')
                            <p>{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Новый пароль -->
                        <div class="profile-page-field">
                            <label for="profile-password">Новый пароль</label>
                            <input type="password" name="password" id="profile-password" placeholder="Введите новый пароль" class="profile-page-input">
                            @error('password')
                            <p>{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Подтверждение нового пароля -->
                        <div class="profile-page-field">
                            <label for="profile-password_confirmation">Подтвердите новый пароль</label>
                            <input type="password" name="password_confirmation" id="profile-password_confirmation" placeholder="Подтвердите новый пароль" class="profile-page-input">
                            @error('password_confirmation')
                            <p>{{ $message }}</p>
                            @enderror
                        </div>

                        <button class="profile-page-save-btn" type="submit">С0ХРАНИТЬ ИЗМЕНЕНИЯ</button>
                    </form>

                    <!-- Текущие данные (поля для отображения) -->
                    <div class="profile-page-field" id="login-field">
                        <label for="profile-login">Логин</label>
                        <p>{{ auth()->user()->login }}</p>
                    </div>

                    <div class="profile-page-field" id="email-field">
                        <label for="profile-email">Email</label>
                        <p>{{ auth()->user()->email }}</p>
                    </div>

                    <div class="profile-page-field" id="birthday-field">
                        <label for="profile-birthday">День рождения</label>
                        <p>{{ auth()->user()->birthday }}</p>
                    </div>

                    <button type="button" class="profile-page-edit-btn" id="edit-button">ИЗМЕНИТЬ ДАННЫЕ</button>
                </div>
            </div>
            <!-- Форма выхода -->
            <form action="{{ route('logout') }}" method="POST" class="profile-page-logout-form">
                @csrf
                <div class="profile-page-logout-wrapper">
                    <button class="profile-page-logout-btn" type="submit">ВЫЙТИ</button>
                </div>
            </form>
        </div>
        <div class="profile-page-discussion">
            <h2>Мои обсуждения</h2>
            @forelse($discussions as $discussion)
                <div>
                    <a href="{{ route('discussions.show', $discussion->id) }}" class="profile-page-discussion-a">
                        {{ $discussion->title }}
                    </a>
                </div>
            @empty
                <p>Вы ещё не создавали обсуждений.</p>
            @endforelse
        </div>
    </section>
    <script>
        document.getElementById('edit-button').addEventListener('click', function () {
            // Сделать поля input редактируемыми
            document.querySelectorAll('.profile-page-input').forEach(input => input.removeAttribute('readonly'));

            // Показать форму редактирования
            document.getElementById('profile-form').classList.remove('hidden');

            // Скрыть текущие значения (параграфы) для редактирования
            document.getElementById('login-field').style.display = 'none';
            document.getElementById('email-field').style.display = 'none';
            document.getElementById('birthday-field').style.display = 'none';
        });
    </script>
@endsection
