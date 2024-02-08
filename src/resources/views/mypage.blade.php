@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="mypage__title">
        <h1>{{$user_name}}さん</h1>
    </div>
    <div class="mypage__content">
        <div class="mypage__reservation-status">
            <h2>予約状況</h2>
            @foreach($reservations as $reservation)
            <div class="reservation-block">
                <div class="reservation-block__header">
                    <div>
                        <img src="/images/clock.png" alt="clock">
                        <span>予約{{ $loop->iteration }}</span>
                    </div>
                    <form class="reservation-block__form" action="{{ url('/reservation/delete') }}" method="post" onsubmit="return cancelReservationConfirmation({{ $reservation->id }});">
                        @csrf
                        <input type="hidden" name="id" value="{{ $reservation->id }}">
                        <button type="submit" class="reservation-block__button">
                            <i class="fa-regular fa-circle-xmark"></i>
                        </button>
                    </form>
                </div>
                <table class="reservation-table">
                    <tr class="reservation-table__row">
                        <th class="reservation-table__header">Shop</th>
                        <td class="reservation-table__data">{{$reservation->shop->shop_name}}</td>
                    </tr>
                    <tr class="reservation-table__row">
                        <th class="reservation-table__header">Date</th>
                        <td class="reservation-table__data">{{$reservation->reservation_date}}</td>
                    </tr>
                    <tr class="reservation-table__row">
                        <th class="reservation-table__header">Time</th>
                        <td class="reservation-table__data">{{$reservation->formatted_time}}</td>
                    </tr>
                    <tr class="reservation-table__row">
                        <th class="reservation-table__header">Number</th>
                        <td class="reservation-table__data">{{$reservation->member_count}}人</td>
                    </tr>
                </table>
            </div>
            @endforeach
        </div>
        <div class="mypage__favorite-shop">
            <h2>お気に入り店舗</h2>
            <div class="mypage__favorite-shop__inner">
                @foreach ($favorites as $favorite)
                <div class="shop__card">
                    @php
                    $filenames = [
                    1 => 'sushi.jpg',
                    2 => 'yakiniku.jpg',
                    3 => 'izakaya.jpg',
                    4 => 'italian.jpg',
                    5 => 'ramen.jpg',
                    ];
                    $image_path = 'images/' . $filenames[$favorite->shop->shop_genre_id];
                    @endphp
                    <div class="shop__card-img">
                        <img src="{{ asset($image_path) }}" alt="shop_image {{ $favorite->shop->shopGenre->shop_genre }}">
                    </div>
                    <div class="shop__card-text">
                        <p class="shop__title">{{ $favorite->shop->shop_name }}</p>
                        <span class="shop__info">#{{ $favorite->shop->shopArea->shop_area }}</span>
                        <span class="shop__info">#{{ $favorite->shop->shopGenre->shop_genre }}</span>
                        <div class="shop__unit">
                            <a href="shop/detail?id={{$favorite->shop->id}}" class="shop__detail">詳しくみる</a>
                            @if (Auth::check())
                            <div>
                                <form class="" action="{{ url('/favorite/'.$favorite->shop->id) }}" method="post">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="shop_id" value="{{ $favorite->shop->id }}">
                                    <button type="submit" class="shop__favorite">
                                        <i class="fa-solid fa-heart {{ $favorite->where('user_id', Auth::id())->count() > 0 ? 'shop__favorite--red' : 'shop__favorite--gray' }}"></i>
                                    </button>
                                </form>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/cancel-reservation.js') }}"></script>
@endsection