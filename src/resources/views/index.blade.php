@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('search')
<div class="shop__search">
    <form class="shop__form" action="/search" method="get">
        @csrf
        <div class="shop__form__item">
            <select class="shop__form__item-area" name="shop_area_id">
                <option value="">All area</option>
                @foreach ($shop_areas as $shop_area)
                <option value="{{ $shop_area['id'] }}">{{ $shop_area['shop_area'] }}</option>
                @endforeach
            </select>
            <select class="shop__form__item-genre" name="shop_genre_id">
                <option value="">All genre</option>
                @foreach ($shop_genres as $shop_genre)
                <option value="{{ $shop_genre['id'] }}">{{ $shop_genre['shop_genre'] }}</option>
                @endforeach
            </select>
            <div class="shop__form__input">
                <button class="shop__form__input-button" type="submit">
                    <img src="/images/search.png">
                </button>
                <input class="shop__form__input-keyword" type="search" name="keyword" placeholder="Search…" value="{{ old('keyword') }}">
            </div>
        </div>
    </form>
</div>
@endsection

@section('content')
<div class="shop__content">
    @foreach ($shops as $shop)
    <div class="shop__card">
        @php
        $imagePath = '';

        switch ($shop['shop_genre_id']) {
        case 1:
        $imagePath = 'images/sushi.jpg';
        break;
        case 2:
        $imagePath = 'images/yakiniku.jpg';
        break;
        case 3:
        $imagePath = 'images/izakaya.jpg';
        break;
        case 4:
        $imagePath = 'images/italian.jpg';
        break;
        case 5:
        $imagePath = 'images/ramen.jpg';
        break;
        }
        @endphp
        <div class="shop__card-img">
            <img src="{{ asset($imagePath) }}" alt="Shop Image {{ $shop['shopGenre']['shop_genre'] }}">
        </div>
        <div class="shop__card-text">
            <p class="">{{ $shop['shop_name'] }}</p>
            <span>#{{ $shop['shopArea']['shop_area'] }}</span>
            <span>#{{ $shop['shopGenre']['shop_genre'] }}</span>
            <a href="shop/detail">詳しくみる</a>
            @if (Auth::check())
            <div class="shop__card-favorite">
                <form class="" action="{{ url('/favorite/'.$shop['id']) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="shop_id" value="{{ $shop['id'] }}">
                    <button type="submit" class="">
                        <i class="fa-solid fa-heart {{ $shop->favorite->where('user_id', Auth::id())->count() > 0 ? 'shop__card-favorite--red' : 'shop__card-favorite--gray' }}"></i>
                    </button>
                </form>
            </div>
            @endif
        </div>
    </div>
    @endforeach
</div>

@if (Auth::check())
現在ログイン中です
<form class="form" action="/logout" method="post">
    @csrf
    <button class="header-nav__button">ログアウト</button>
</form>
@endif

@endsection