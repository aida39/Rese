@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('content')
<div class="thanks__container">
    <div class="thanks__content">
        <p class="thanks__message">ご予約ありがとうございます</p>
        <div class="thanks__button-area">
            <a class="thanks__button" href="/mypage">戻る</a>
        </div>
    </div>
</div>
@endsection