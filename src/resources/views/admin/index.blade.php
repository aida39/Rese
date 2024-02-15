@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="shop__content">
    <p>管理者ページです</p>
    <a class="menu__nav__link" href="/admin/logout">Logout</a>

</div>
@endsection