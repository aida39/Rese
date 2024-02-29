@extends('layouts.app_admin')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('content')
<div class="thanks__container">
    <div class="thanks__content">
        <p class="thanks__message">メールを送信しました</p>
        <div class="thanks__button-area">
            <a class="thanks__button" href="/admin/mail">戻る</a>
        </div>
    </div>
</div>
@endsection