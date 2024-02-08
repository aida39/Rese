@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('content')
<div class="thanks__container">
    <div class="thanks__content">
        <p class="thanks__message">会員登録ありがとうございます</p>
        <div class="login__button-area">
            <a href="/login" class="login__button">ログインする</a>
        </div>
    </div>
</div>
@endsection