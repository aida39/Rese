@extends('layouts.app_manager')

@section('css')
<link rel="stylesheet" href="{{ asset('css/manager.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="review__content">
        <h1 class="title">評価</h1>
        @if($reviews->isEmpty())
        <p>評価はまだありません</p>
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
@endsection