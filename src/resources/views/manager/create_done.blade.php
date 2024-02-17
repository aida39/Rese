@extends('layouts.app_manager')

@section('css')
<link rel="stylesheet" href="{{ asset('css/done.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="content">
        <p class="message">店舗情報を作成しました</p>
        <div class="button-area">
            <a href="index" class="button">戻る</a>
        </div>
    </div>
</div>
@endsection