<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="css/all.min.css">
    @yield('css')
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <div class="header__logo">
                <nav class="nav" id="nav">
                    <ul>
                        <ul class="menu-nav">
                            @if (Auth::check())
                            <li class="menu-nav__item">
                                <a class="menu-nav__link" href="/">Home</a>
                            </li>
                            <li class="menu-nav__item">
                                <a class="menu-nav__link" href="/logout">Logout</a>
                            </li>
                            <li class="menu-nav__item">
                                <a class="menu-nav__link" href="/mypage">Mypage</a>
                            </li>
                            @else
                            <li class="menu-nav__item">
                                <a class="menu-nav__link" href="/">Home</a>
                            </li>
                            <li class="menu-nav__item">
                                <a class="menu-nav__link" href="/register">Registration</a>
                            </li>
                            <li class="menu-nav__item">
                                <a class="menu-nav__link" href="/login">Login</a>
                            </li>
                            @endif
                        </ul>
                    </ul>
                </nav>
                <div class="menu" id="menu">
                    <img src="/images/logo_open.png" alt="logo_open" id="menuImage">
                </div>
                <h1 class="header__title">
                    Rese
                </h1>
            </div>
            @yield('search')
    </header>
    <main>
        @yield('content')
    </main>
    <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>