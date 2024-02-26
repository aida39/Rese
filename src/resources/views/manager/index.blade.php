@extends('layouts.app_manager')

@section('css')
<link rel="stylesheet" href="{{ asset('css/manager.css') }}">
@endsection

@section('content')
<div class="shop__content">
    <h1 class="title">{{$manager->name}}さん担当店舗</h1>
    <div class="shop__content__inner">
        @foreach($shops as $shop)
        <div class="shop__card">
            <div class="shop__card-img">
                <img src="{{ asset($shop->image_path) }}" alt="店舗画像">
            </div>
            <div class="shop__card-text">
                <p class="shop__title">{{$shop->shop_name}}</p>
                <span class="shop__info">#{{$shop->shopArea->shop_area}}</span>
                <span class="shop__info">#{{$shop->shopGenre->shop_genre}}</span>
                <div class="shop__unit">
                    <a class="shop__detail" href="edit?id={{$shop['id']}}">店舗情報の更新</a>
                    <a class=" shop__detail" href="reservation?id={{$shop['id']}}">予約情報の確認</a>
                    <a class=" shop__detail" href="review?id={{$shop['id']}}">評価の確認</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection