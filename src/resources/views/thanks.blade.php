@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
<div class="thanks__content">
    <p>会員登録ありがとうございます</p>
    <a href="/login">ログインする</a>
</div>
@endsection