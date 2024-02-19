@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/done.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="content">
        <p class="message">ご予約ありがとうございます</p>
        <div class="button-area">
            <a href="/mypage" class="button">戻る</a>
        </div>
    </div>
</div>
@endsection