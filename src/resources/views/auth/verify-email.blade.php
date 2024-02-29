@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('content')
<div class="thanks__container">
    <div class="thanks__content">
        <h1 class="verify-email__title">アカウント登録を完了してください</h1>
        <p class="verify-email__message">登録したメールアドレス宛てにメールを送信しました。<br>
            メールに記載されているリンクをクリックして、登録手続きを完了してください。</p>
        <div class="thanks__button-area">
            <a href="/" class="thanks__button">戻る</a>
        </div>
    </div>
</div>
@endsection