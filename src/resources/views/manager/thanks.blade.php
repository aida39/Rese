@extends('layouts.app_manager')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('content')
<div class="thanks__container">
    <div class="thanks__content">
        <p class="thanks__message">会員登録ありがとうございます</p>
        <div class="thanks__button-area">
            <a class="thanks__button" href="/manager/login">ログインする</a>
        </div>
    </div>
</div>
@endsection