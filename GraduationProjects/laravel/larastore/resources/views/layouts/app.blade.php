<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
</head>
<body>
<div id="app" class="h-100">
    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
        <div class="container-fluid p-0">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            @if (!Auth::guest())
                @if(Auth::user()->is_admin)
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="/">К сайту</a>
                            </li>
                            <li class="nav-item" id="link-goods">
                                <a class="nav-link" href="/admin">Товары</a>
                            </li>
                            <li class="nav-item" id="link-categories">
                                <a class="nav-link" href="/admin/categories">Категории</a>
                            </li>
                            <li class="nav-item" id="link-categories">
                                <a class="nav-link" href="/admin/orders">Заказы</a>
                            </li>
                            <li class="nav-item" id="link-categories">
                                <a class="nav-link" href="/admin/notification/edit">Настройка уведомлений</a>
                            </li>
                        </ul>
                    </div>
                @endif
            @endif

            <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    @if (Auth::guest())
                        <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Войти</a></li>
                        <li class="nav-item"><a href="{{ route('register') }}" class="nav-link">Регистрация</a></li>
                    @else
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                <a href="{{ route('logout') }}" class="dropdown-item"
                                   onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </div>
                        </li>
                    @endif
                </ul>
            </div>

        </div>
    </nav>
    <div class="container-fluid main-content px-0">
        <div class="row flex-xl-nowrap h-100 mx-0">
            @if(Request::is('/') || Request::is('category/filter/*'))
                <div class="col-12 col-md-3 col-xl-2 py-3 bd-sidebar">
                    <h3>Категории</h3>
                    <sidemenu></sidemenu>
                </div>
            @endif
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 px-0">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
