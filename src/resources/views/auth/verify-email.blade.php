<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">
    @yield('css')
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <nav class="menu__nav" id="nav">
                <ul>
                    <ul class="menu__nav__list">
                        @if (Auth::check())
                        <li class="menu__nav__item">
                            <a class="menu__nav__link" href="/logout">Home</a>
                        </li>
                        @endif
                    </ul>
                </ul>
            </nav>
            <div class="menu__icon" id="menu">
                <img src="/images/logo_open.png" alt="logo_open" class="menu__icon__image" id="menuImage">
            </div>
            <h1 class="header__title">
                Rese
            </h1>
        </div>
    </header>
    <main>
        <div class="thanks__container">
            <div class="thanks__content">
                <h1 class="verify-email__title">アカウント登録を完了してください</h1>
                <p class="verify-email__message">登録したメールアドレス宛てにメールを送信しました。<br>
                    メールに記載されているリンクをクリックして、登録手続きを完了してください。</p>
                <!-- ユーザー登録時ログインしない場合、以下の記述は不要、削除する、CSSも削除 -->
                <!-- <div class="thanks__button-area">
                    <p class="verify-email__link-message">メールアドレスを誤って登録した方はこちらから</p>
                    <form class="form" action="/logout" method="post">
                        @csrf
                        <button class="verify-email__link-button">戻る</button>
                    </form>
                </div> -->
                <div class="thanks__button-area">
                    <a href="/" class="thanks__button">戻る</a>
                </div>
            </div>
        </div>
    </main>
    <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>