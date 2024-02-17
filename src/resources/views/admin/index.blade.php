@extends('layouts.app_admin')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('content')
<div class="admin__menu">
    <h1 class="admin__menu__title">管理者用 管理画面</h1>
    <div class="admin__menu__inner">
        <a class="admin__menu__link" href="/admin/register">店舗代表者の作成</a>
    </div>
    <div class="admin__menu__inner">
        <a class="admin__menu__link" href="/admin">メール送信</a>
    </div>
    <div class="admin__menu__inner">
        <a class="admin__menu__link" href="/admin/logout">ログアウト</a>
    </div>
</div>
@endsection