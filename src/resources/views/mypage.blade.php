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
            <div class="error-message">
                @error('reservation_time')
                {{ $message }}
                @enderror
            </div>
            <div class="error-message">
                @error('member_count')
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
                                <input class="reservation-date" type="date" name="reservation_date" value="{{ old('reservation_date', $future_reservation->reservation_date) }}">
                            </td>
                        </tr>
                        <tr class="reservation-table__row">
                            <th class="reservation-table__header">Time</th>
                            <td class="reservation-table__data">
                                <select class="reservation-time" name="reservation_time">
                                    <option value="17:00:00" {{ old('reservation_time', $future_reservation->reservation_time) == '17:00:00' ? 'selected' : '' }}>17:00</option>
                                    <option value="17:30:00" {{ old('reservation_time', $future_reservation->reservation_time) == '17:30:00' ? 'selected' : '' }}>17:30</option>
                                    <option value="18:00:00" {{ old('reservation_time', $future_reservation->reservation_time) == '18:00:00' ? 'selected' : '' }}>18:00</option>
                                    <option value="18:30:00" {{ old('reservation_time', $future_reservation->reservation_time) == '18:30:00' ? 'selected' : '' }}>18:30</option>
                                    <option value="19:00:00" {{ old('reservation_time', $future_reservation->reservation_time) == '19:00:00' ? 'selected' : '' }}>19:00</option>
                                    <option value="19:30:00" {{ old('reservation_time', $future_reservation->reservation_time) == '19:30:00' ? 'selected' : '' }}>19:30</option>
                                    <option value="20:00:00" {{ old('reservation_time', $future_reservation->reservation_time) == '20:00:00' ? 'selected' : '' }}>20:00</option>
                                    <option value="20:30:00" {{ old('reservation_time', $future_reservation->reservation_time) == '20:30:00' ? 'selected' : '' }}>20:30</option>
                                    <option value="21:00:00" {{ old('reservation_time', $future_reservation->reservation_time) == '21:00:00' ? 'selected' : '' }}>21:00</option>
                                </select>
                            </td>
                        </tr>
                        <tr class="reservation-table__row">
                            <th class="reservation-table__header">Number</th>
                            <td class="reservation-table__data">
                                <select class="member_count" name="member_count">
                                    <option value="1" {{ old('member_count', $future_reservation->member_count) == 1 ? 'selected' : '' }}>1人</option>
                                    <option value="2" {{ old('member_count', $future_reservation->member_count) == 2 ? 'selected' : '' }}>2人</option>
                                    <option value="3" {{ old('member_count', $future_reservation->member_count) == 3 ? 'selected' : '' }}>3人</option>
                                    <option value="4" {{ old('member_count', $future_reservation->member_count) == 4 ? 'selected' : '' }}>4人</option>
                                    <option value="5" {{ old('member_count', $future_reservation->member_count) == 5 ? 'selected' : '' }}>5人</option>
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
                    <div class="shop__card-img">
                        <img src="{{ asset($favorite->shop->image_path) }}" alt="shop_image {{ $favorite->shop->shopGenre->shop_genre }}">
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
                    <p class="review__button review__button--inactive">評価済み</p>
                    @endif
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
<script src="{{ asset('js/cancel-reservation.js') }}"></script>
@endsection