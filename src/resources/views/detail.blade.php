@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('search')

@endsection

@section('content')
<div class="left-container shop-detail__content">
    <div class="shop-detail__title">
        <a href="/">&lt;</a>
        <h1 class="shop-name">{{ $shop['shop_name'] }}</h1>
    </div>
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
    <div class="shop-detail__img">
        <img src="{{ asset($imagePath) }}" alt="Shop Image {{ $shop['shopGenre']['shop_genre'] }}">
    </div>
    <div class="shop-detail__text">
        <span>#{{ $shop['shopArea']['shop_area'] }}</span>
        <span>#{{ $shop['shopGenre']['shop_genre'] }}</span>
        <p class="">{{ $shop['shop_description'] }}</p>

    </div>
</div>

<div class="right-container reservation__content">
    <h2>予約</h2>
    @if (Auth::check())
    <form class="form" action="/reservation/create" method="post">
        @csrf
        <div class="reservation__input-field">
            <input type="date" name="reservation_date" value="<?php echo date('Y-m-d'); ?>" id="reservationDate">
            <select name="reservation_time" id="reservationTime">
                <option value="17:00:00">17:00</option>
                <option value="17:30:00">17:30</option>
                <option value="18:00:00">18:00</option>
                <option value="18:30:00">18:30</option>
                <option value="19:00:00">19:00</option>
                <option value="19:30:00">19:30</option>
                <option value="20:00:00">20:00</option>
                <option value="20:30:00">20:30</option>
                <option value="21:00:00">21:00</option>
            </select>
            <select name="member_count" id="reservationPeople">
                <option value="1">1人</option>
                <option value="2">2人</option>
                <option value="3">3人</option>
                <option value="4">4人</option>
                <option value="5">5人</option>
            </select>
            <input type="hidden" name="shop_id" value="{{ $shop['id'] }}">
        </div>
        <div class="reservation__confirm-field" id="confirmField">
        </div>

        <div class="reservation-button__area">
            <button class="reservation-button" type="submit">予約する</button>
        </div>
        @else
        <p>IDをお持ちの方</p>
        <a href="/login">ログインして予約する</a>
        <p>IDをお持ちでない方</p>
        <a href="/register">会員登録して予約する</a>
        @endif
    </form>
</div>
<div id="storeName" data-name="{{ $shop['shop_name'] }}"></div>
<script src="{{ asset('js/show-reservation.js') }}"></script>
@endsection