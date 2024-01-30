<h1>飲食店一覧ページです</h1>

@if (Auth::check())
現在ログイン中です
<form class="form" action="/logout" method="post">
    @csrf
    <button class="header-nav__button">ログアウト</button>
</form>
@endif