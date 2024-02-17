@extends('layouts.app_manager')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="admin__menu">
        <h1 class="admin__menu__title">店舗代表者用 管理画面</h1>
        <div class="admin__menu__inner">
            <a class="admin__menu__link" href="create">店舗情報の作成</a>
        </div>
        <div class="admin__menu__inner">
            <a class="admin__menu__link" href="logout">ログアウト</a>
        </div>
    </div>
    <div class="admin__shop-area">
        @foreach($shops as $shop)
        <div class="shop__card">
            <div class="shop__card-text">
                <p class="shop__title">{{$shop->shop_name}}</p>
                <span class="shop__info">#{{$shop->shopArea->shop_area}}</span>
                <span class="shop__info">#{{$shop->shopGenre->shop_genre}}</span>
                <div class="shop__unit">
                    <a class="shop__detail" href="edit?id={{$shop['id']}}">店舗情報の更新</a>
                    <a class=" shop__detail" href="reservation?id={{$shop['id']}}">予約情報の確認</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection