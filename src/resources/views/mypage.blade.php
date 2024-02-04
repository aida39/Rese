@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="mypage-__title">
        <h1>{{$user_name}}さん</h1>
    </div>
    <div class="mypage__content">
        <div class="mypage__reservation-status">
            <h2>予約状況</h2>
            @foreach($reservations as $reservation)
            <div class="reservation-block">
                <div class="reservation-block__header">
                    <img src="/images/clock.png" alt="clock">
                    <span>予約{{ $loop->iteration }}</span>
                    <form class="reservation-block__form" action="{{ url('/reservation/delete') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{ $reservation->id }}">
                        <button type="submit" class="reservation-block__button">
                            <i class="fa-regular fa-circle-xmark"></i>
                        </button>
                    </form>
                </div>
                <table class="reservation-table">
                    <tr>
                        <th>Shop</th>
                        <td>{{$reservation->shop->shop_name}}</td>
                    </tr>
                    <tr>
                        <th>Date</th>
                        <td>{{$reservation->reservation_date}}</td>
                    </tr>
                    <tr>
                        <th>Time</th>
                        <td>{{$reservation->formatted_time}}</td>
                    </tr>
                    <tr>
                        <th>Number</th>
                        <td>{{$reservation->member_count}}人</td>
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
                        <p class="">{{ $favorite->shop->shop_name }}</p>
                        <span>#{{ $favorite->shop->shopArea->shop_area }}</span>
                        <span>#{{ $favorite->shop->shopGenre->shop_genre }}</span>
                        <a href="shop/detail?id={{$favorite->shop->id}}">詳しくみる</a>
                        @if (Auth::check())
                        <div class="shop__card-favorite">
                            <form class="" action="{{ url('/favorite/'.$favorite->shop->id) }}" method="post">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="shop_id" value="{{ $favorite->shop->id }}">
                                <button type="submit" class="">
                                    <i class="fa-solid fa-heart {{ $favorite->where('user_id', Auth::id())->count() > 0 ? 'shop__card-favorite--red' : 'shop__card-favorite--gray' }}"></i>
                                </button>
                            </form>
                        </div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>

    </div>
</div>
@endsection