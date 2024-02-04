<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <a href="javascript:void(0);" onclick="history.go(-1)">
                <img src="/images/logo_close.png" alt="logo_close">
            </a>
        </div>
    </header>
    <main>
        <div class="menu-content">
            <nav>
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
            </nav>
        </div>
    </main>
</body>

</html>