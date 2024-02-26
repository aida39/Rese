@extends('layouts.app_admin')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('content')
<div class="thanks__container">
    <div class="thanks__content">
        <h1 class="verify-email__title">アカウント登録はまだ完了していません</h1>
        <p class="verify-email__message">登録したメールアドレス宛てにメールを送信しました。<br>
            メールに記載されているリンクをクリックして、登録手続きを完了するよう、店舗代表者に連絡してください。</p>
        <div class="thanks__button-area">
            <a href="/admin/index" class="thanks__button">戻る</a>
        </div>
    </div>
</div>
@endsection