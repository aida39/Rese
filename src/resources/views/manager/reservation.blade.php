@extends('layouts.app_manager')

@section('css')
<link rel="stylesheet" href="{{ asset('css/manager.css') }}">
@endsection

@section('content')
<div class="container">
    @if($reservations->isEmpty())
    <p class="reservation__message">現在予約はありません</p>
    @else
    <h1 class="title">{{$reservations->first()->shop->shop_name}}の予約状況</h1>
    @foreach($reservations as $reservation)
    <div class=" reservation-block">
        <div class="reservation-block__header">
            <div>
                <img src="/images/clock.png" alt="clock">
                <span>予約{{ $loop->iteration }}</span>
            </div>
        </div>
        <table class="reservation-table">
            <tr class="reservation-table__row">
                <th class="reservation-table__header">Name</th>
                <td class="reservation-table__data">{{$reservation->user->name}}</td>
            </tr>
            <tr class="reservation-table__row">
                <th class="reservation-table__header">Date</th>
                <td class="reservation-table__data">{{$reservation->reservation_date}}</td>
            </tr>
            <tr class="reservation-table__row">
                <th class="reservation-table__header">Time</th>
                <td class="reservation-table__data">{{ $reservation->formatted_time}}</td>
            </tr>
            <tr class="reservation-table__row">
                <th class="reservation-table__header">Number</th>
                <td class="reservation-table__data">{{$reservation->member_count}}人</td>
            </tr>
        </table>
</div>
@endforeach
@endif
</div>
@endsection