@extends('layouts.layout')
@section('title', 'LibraryAI | Профиль')
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
                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" id="profile-form" class="profile-page-form hidden">
                        @csrf
                        @method('PUT')
                        <div class="profile-page-field">
                            <label for="profile-login">Логин</label>
                            <input  class="profile-page-input" type="text" id="profile-login" name="login"
                                   value="{{ old('login', auth()->user()->login) }}" required>
                        </div>
                        <div class="profile-page-field">
                            <label for="profile-email">Email</label>
                            <input  class="profile-page-input" type="email" id="profile-email" name="email"
                                   value="{{ old('email', auth()->user()->email) }}" required>
                        </div>
                        <div class="profile-page-field">
                            <label for="profile-birthday">День рождения</label>
                            <input style="border-bottom: none" class="profile-page-input" type="date" id="profile-birthday" name="birthday"
                                   value="{{ old('birthday', auth()->user()->birthday) }}" required>
                        </div>
                        <div class="profile-page-field">
                            <label for="profile-avatar_url">Новый аватар</label>
                            <input type="file" name="avatar_url" id="profile-avatar_url" accept="image/jpeg,image/png,image" class="file-input">
                        </div>
                        <div class="profile-page-field">
                            <label for="profile-password">Новый пароль</label>
                            <input type="password" name="password" id="profile-password" placeholder="Введите новый пароль" class="profile-page-input">
                        </div>
                        <div class="profile-page-field">
                            <label for="profile-password_confirmation">Подтвердите новый пароль</label>
                            <input type="password" name="password_confirmation" id="profile-password_confirmation" placeholder="Подтвердите новый пароль" class="profile-page-input">
                        </div>
                        <div class="edit-buttons">
                            <button class="profile-page-save-btn" type="submit">С0ХРАНИТЬ ИЗМЕНЕНИЯ</button>
                            <button type="button" class="profile-page-cancel-btn" id="cancel-button" style="display: none;">ОТМЕНИТЬ</button>
                        </div>
                    </form>
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
                    <button type="button" class="profile-page-cancel-btn" id="cancel-button" style="display: none;">ОТМЕНИТЬ</button>
                </div>
            </div>
            @if ($errors->any())
                <div class="alert-danger" style="padding: 10px">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
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
                        | {{ $discussion->status === 1 ? 'Активно' : 'Не активно' }}
                </div>
            @empty
                <p>Вы ещё не создавали обсуждений.</p>
            @endforelse
        </div>
    </section>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const editButton = document.getElementById('edit-button');
            const cancelButton = document.getElementById('cancel-button');
            const profileForm = document.getElementById('profile-form');
            const infoFields = [
                document.getElementById('login-field'),
                document.getElementById('email-field'),
                document.getElementById('birthday-field')
            ];
            // При клике на "Изменить данные"
            editButton.addEventListener('click', function () {
                // Сделать поля редактируемыми
                document.querySelectorAll('.profile-page-input').forEach(input => input.removeAttribute('readonly'));
                // Показать форму
                profileForm.classList.remove('hidden');
                // Скрыть статические поля
                infoFields.forEach(field => field.style.display = 'none');
                // Скрыть кнопку "Изменить" и показать "Отменить"
                editButton.style.display = 'none';
                cancelButton.style.display = 'inline-block';
            });
            // При клике на "Отменить"
            cancelButton.addEventListener('click', function () {
                // Сброс формы без отправки
                profileForm.reset();
                // Восстановить значения из текущего профиля или old()
                document.getElementById('profile-login').value = "{{ old('login', auth()->user()->login) }}";
                document.getElementById('profile-email').value = "{{ old('email', auth()->user()->email) }}";
                document.getElementById('profile-birthday').value = "{{ old('birthday', auth()->user()->birthday) }}";
                // Скрыть форму
                profileForm.classList.add('hidden');
                // Показать статические поля
                infoFields.forEach(field => field.style.display = 'block');
                // Скрыть кнопку "Отменить" и показать "Изменить"
                cancelButton.style.display = 'none';
                editButton.style.display = 'inline-block';
            });
        });
    </script>
@endsection
