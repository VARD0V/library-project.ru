<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('assets/images/icon.png') }}">
    <title>@yield('title')</title>
    <style>
        header {
            background-color: #3D9AD1;
            padding: 10px 20px;
            border-bottom: 1px solid #ddd;
        }
        header nav a {
            margin-right: 15px;
            text-decoration: none;
            color: white;
        }
        header nav a:hover {
            text-decoration: underline;
        }
        main {
            padding: 20px;
        }
    </style>
</head>
<body>

<header>
    <nav>
        <a href="{{ route('discussions.index') }}">Обсуждения</a>
        <a href="{{ route('articles.index') }}">Статьи</a>
        <a href="{{ route('home') }}"><img src="{{asset('assets/images/logo.png')}}" alt="logo" width="60"></a>
        <a href="{{ route('ai.index') }}">ИИ</a>
        @if(auth()->check())
            <a href="{{ route('profile') }}">Профиль</a>
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" style="background: none; border: none; color: #007bff; cursor: pointer;">Выйти</button>
            </form>
        @else
            <a href="{{ route('login') }}">Войти</a>
            <a href="{{ route('register') }}">Регистрация</a>
        @endif
    </nav>
</header>

<main>
    @yield('content')
</main>

<footer>
</footer>

</body>
</html>
