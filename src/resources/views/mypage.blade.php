@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="mypage__title">
        <h1>{{$user->name}}さん</h1>
    </div>
    <div class="mypage__wrapper">
        <div class="mypage__reservation-status">
            <h2>予約状況</h2>
            <div class="error-message">
                @error('reservation_date')
                {{ $message }}
                @enderror
            </div>
            @foreach($future_reservations as $future_reservation)
            <div class="reservation-block">
                <div class="reservation-block__header">
                    <div>
                        <img src="/images/clock.png" alt="clock">
                        <span>予約{{ $loop->iteration }}</span>
                    </div>
                    <form class="reservation-block__form-delete" action="{{ route('reservation_delete', ['reservation_id' => $future_reservation->id ]) }}" method="post" onsubmit="cancelReservationConfirmation(event);">
                        @csrf
                        <input type="hidden" name="id" value="{{ $future_reservation->id }}">
                        <button type="submit" class="reservation-block__button">
                            <i class="fa-regular fa-circle-xmark"></i>
                        </button>
                    </form>
                </div>
                <form class="reservation-block__form-update" action="{{ url('/reservation/update') }}" method="post">
                    @csrf
                    <table class="reservation-table">
                        <tr class="reservation-table__row">
                            <th class="reservation-table__header">Shop</th>
                            <td class="reservation-table__data">{{$future_reservation->shop->shop_name}}</td>
                        </tr>
                        <tr class="reservation-table__row">
                            <th class="reservation-table__header">Date</th>
                            <td class="reservation-table__data">
                                <input type="hidden" name="id" value="{{$future_reservation->id}}">
                                <input class="reservation-date" type="date" name="reservation_date" value="{{$future_reservation->reservation_date}}">
                            </td>
                        </tr>
                        <tr class="reservation-table__row">
                            <th class="reservation-table__header">Time</th>
                            <td class="reservation-table__data">
                                <select class="reservation-time" name="reservation_time">
                                    @foreach (['17:00', '17:30', '18:00', '18:30', '19:00', '19:30', '20:00', '20:30', '21:00'] as $time)
                                    <option value="{{$time . ':00'}}" {{ $future_reservation->formatted_time == $time ? 'selected' : '' }}>{{$time}}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr class="reservation-table__row">
                            <th class="reservation-table__header">Number</th>
                            <td class="reservation-table__data">
                                <select class="member_count" name="member_count">
                                    @for ($i = 1; $i <= 5; $i++) <option value="{{$i}}" @if ($i==$future_reservation->member_count) selected @endif>{{$i}}人</option>
                                        @endfor
                                </select>
                            </td>
                        </tr>
                    </table>
                    <div class="reservation-update__area">
                        <button class="reservation-update__button">変更する</button>
                    </div>
                </form>
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
    <div class="visit-history">
        <h2>来店履歴</h2>
        <table class="visit-history__table">
            <tr class="visit-history__table-row">
                <th class="visit-history__table-header">Shop</th>
                <th class="visit-history__table-header">Date</th>
                <th class="visit-history__table-header">Time</th>
                <th class="visit-history__table-header">Number</th>
                <th class="visit-history__table-header">Review</th>
            </tr>
            @foreach($past_reservations as $reservation)
            <tr class="visit-history__table-row">
                <td class="visit-history__table-data">{{$reservation->shop->shop_name}}</td>
                <td class="visit-history__table-data">{{$reservation->reservation_date}}</td>
                <td class="visit-history__table-data">{{$reservation->formatted_time}}</td>
                <td class="visit-history__table-data">{{$reservation->member_count}}人</td>
                <td class="visit-history__table-data">
                    @if(empty($reservation->is_reviewed))
                    <a class="review__button" href="/review/{{$reservation->id}}">評価する</a>
                    @else
                    <p class="review__button inactive">評価済み</p>
                    @endif
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
<script src="{{ asset('js/cancel-reservation.js') }}"></script>
@endsection