@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="container-inner">
        <div class="left-wrapper shop-detail__content">
            <div class="shop-detail__title">
                <a href="/" class="shop-detail__link">&lt;</a>
                <h1 class="shop-detail__name">{{ $shop['shop_name'] }}</h1>
            </div>
            @php
            $filenames = [
            1 => 'sushi.jpg',
            2 => 'yakiniku.jpg',
            3 => 'izakaya.jpg',
            4 => 'italian.jpg',
            5 => 'ramen.jpg',
            ];
            $image_path = 'images/' . $filenames[$shop['shop_genre_id']];
            @endphp
            <div class="shop-detail__img">
                <img src="{{ asset($image_path) }}" alt="Shop Image {{ $shop['shopGenre']['shop_genre'] }}">
            </div>
            <div class="shop-detail__text">
                <span>#{{ $shop['shopArea']['shop_area'] }}</span>
                <span>#{{ $shop['shopGenre']['shop_genre'] }}</span>
                <p class="">{{ $shop['shop_description'] }}</p>
            </div>
        </div>
        <div class="right-wrapper reservation__content">
            <h2 class="reservation__title">予約</h2>
            @if (Auth::check())
            <form class="form" action="/reservation/create" method="post">
                @csrf
                <div class="reservation__input-field">
                    <input type="date" name="reservation_date" value="{{ old('reservation_date', date('Y-m-d')) }}" id="reservationDate">
                    <div class="error-message error-message--white">
                        @error('reservation_date')
                        {{ $message }}
                        @enderror
                    </div>
                    <select name="reservation_time" id="reservationTime">
                        <option value="17:00:00" {{ old('reservation_time') == '17:00:00' ? 'selected' : '' }}>17:00</option>
                        <option value="17:30:00" {{ old('reservation_time') == '17:30:00' ? 'selected' : '' }}>17:30</option>
                        <option value="18:00:00" {{ old('reservation_time') == '18:00:00' ? 'selected' : '' }}>18:00</option>
                        <option value="18:30:00" {{ old('reservation_time') == '18:30:00' ? 'selected' : '' }}>18:30</option>
                        <option value="19:00:00" {{ old('reservation_time') == '19:00:00' ? 'selected' : '' }}>19:00</option>
                        <option value="19:30:00" {{ old('reservation_time') == '19:30:00' ? 'selected' : '' }}>19:30</option>
                        <option value="20:00:00" {{ old('reservation_time') == '20:00:00' ? 'selected' : '' }}>20:00</option>
                        <option value="20:30:00" {{ old('reservation_time') == '20:30:00' ? 'selected' : '' }}>20:30</option>
                        <option value="21:00:00" {{ old('reservation_time') == '21:00:00' ? 'selected' : '' }}>21:00</option>
                    </select>
                    <div class="error-message error-message--white">
                        @error('reservation_time')
                        {{ $message }}
                        @enderror
                    </div>
                    <select name="member_count" id="reservationPeople">
                        <option value="1" {{ old('member_count') == '1' ? 'selected' : '' }}>1人</option>
                        <option value="2" {{ old('member_count') == '2' ? 'selected' : '' }}>2人</option>
                        <option value="3" {{ old('member_count') == '3' ? 'selected' : '' }}>3人</option>
                        <option value="4" {{ old('member_count') == '4' ? 'selected' : '' }}>4人</option>
                        <option value="5" {{ old('member_count') == '5' ? 'selected' : '' }}>5人</option>
                    </select>
                    <div class="error-message error-message--white">
                        @error('member_count')
                        {{ $message }}
                        @enderror
                    </div>
                    <input type="hidden" name="shop_id" value="{{ $shop['id'] }}">
                </div>
                <div class="reservation__confirm-field" id="confirmField">
                    <span id="storeName" data-name="{{ $shop['shop_name'] }}"></span>
                </div>
                <div class="reservation-button__area">
                    <button class="reservation-button" type="submit">予約する</button>
                </div>
            </form>
            @else
            <div class="login__field">
                <div class="login__field__inner">
                    <p class="login__field__message">IDをお持ちの方</p>
                    <a href="/login" class="login__field__link">ログインして予約する</a>
                </div>
                <div class="login__field__inner">
                    <p class="login__field__message">IDをお持ちでない方</p>
                    <a href="/register" class="login__field__link">会員登録して予約する</a>
                </div>
            </div>
            @endif
        </div>
    </div>
    <div class="review__content">
        <h2>口コミ</h2>
        @if($reviews->isEmpty())
        <p>口コミはまだありません</p>
        @else
        @foreach($reviews as $review)
        <div class="review__card">
            <div class="review__title">
                <p>{{ $review->reservation->user->name }}さん</p>
                <p>来店日:{{ $review->reservation->reservation_date }}</p>
            </div>
            <p class="review__rating">評価(5段階):{{ $review->rating }}</p>
            <p class="review__text">{{ $review->comment }}</p>
        </div>
        @endforeach
        @endif
    </div>
</div>
<script src="{{ asset('js/show-reservation.js') }}"></script>
@endsection