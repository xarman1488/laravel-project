<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Testapp')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar {
            box-shadow: 0 2px 4px rgba(0,0,0,.1);
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-white">
    <div class="container">
        <a class="navbar-brand fw-bold">Testapp</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            @auth
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">Главная</a>
                    </li>
                    @if(Auth::user()->is_admin)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.requests.index') }}">Запросы (Админ)</a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('tasks.index') }}">Задачи</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('attachments.index') }}">Документы</a>
                    </li>
                </ul>
            @endauth

            <div class="d-flex align-items-center">
                @guest
                    <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">Войти</a>
                    <a href="{{ route('register') }}" class="btn btn-primary">Зарегистрироваться</a>
                @endguest

                @auth
                    <span class="me-3">{{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger">Выйти</button>
                    </form>
                @endauth
            </div>
        </div>

<main class="py-4">
    @yield('content')
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>
