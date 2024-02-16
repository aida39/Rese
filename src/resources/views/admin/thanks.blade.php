@extends('layouts.app_admin')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('content')
<div class="thanks__container">
    <div class="thanks__content">
        <p class="thanks__message">店舗代表者を登録しました</p>
        <div class="login__button-area">
            <a href="/admin/index" class="login__button">戻る</a>
        </div>
    </div>
</div>
@endsection