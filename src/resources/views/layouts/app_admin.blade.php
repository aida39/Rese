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
            <div class="menu__icon">
                <a class="menu__nav__link" href="/admin/index">
                    <img src="/images/logo_open.png" alt="logo_open" class="menu__icon__image" id="menuImage">
                </a>
            </div>
            <h1 class="header__title">
                Rese
            </h1>
        </div>
    </header>
    <main>
        @yield('content')
    </main>
</body>

</html>