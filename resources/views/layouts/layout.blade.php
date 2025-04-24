<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('assets/images/logo.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/css.css') }}">
    <title>@yield('title')</title>
</head>
<body>

<header>
    <nav>
        <a href="{{ route('discussions.index') }}">0бсуждения</a>
        <a href="{{ route('articles.index') }}">Статьи</a>
        <a href="{{ route('home') }}"><img src="{{ asset('assets/images/logo.png') }}" alt="logo"></a>
        <a href="{{ route('ai.index') }}">ИИ</a>

        <a href="{{ route('profile') }}">Личный кабинет</a>  <!-- Только эта ссылка -->
    </nav>

</header>

<main>
    @yield('content')
</main>

<footer>
</footer>

</body>
</html>
