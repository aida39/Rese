<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <nav class="menu__nav" id="nav">
                <ul>
                    <ul class="menu__nav__list">
                        @if (Auth::guard('admins')->check())
                        <li class="menu__nav__item">
                            <a class="menu__nav__link" href="/admin/index">Home</a>
                        </li>
                        <li class="menu__nav__item">
                            <a class="menu__nav__link" href="/admin/mail">Mail</a>
                        </li>
                        <li class="menu__nav__item">
                            <a class="menu__nav__link" href="/admin/logout">Logout</a>
                        </li>
                        @else
                        <li class="menu__nav__item">
                            <a class="menu__nav__link" href="/admin/login">Login</a>
                        </li>
                        @endif
                    </ul>
                </ul>
            </nav>
            <div class="menu__icon" id="menu">
                <img src="/images/logo_open.jpg" alt="logo_open" class="menu__icon__image" id="menuImage">
            </div>
            <h1 class="header__title">
                Rese
            </h1>
        </div>
    </header>
    <main>
        @yield('content')
    </main>
    <script src="{{ asset('js/drawer-menu.js') }}"></script>
</body>

</html>