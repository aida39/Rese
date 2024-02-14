@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/review.css') }}">
@endsection

@section('content')
<div class="review__container">
    <div class="review__content">
        <div class="review__header">
            <h1>来店評価</h1>
        </div>
        <form class="review-form" action="/review" method="post">
            @csrf
            <div class="review-form__group">
                <div>
                    <p class="review-form__label">飲食店名</p>
                    <span class="review-form__value">{{$reservation->shop->shop_name}}</span>
                </div>
                <div>
                    <p class="review-form__label">来店日時</p>
                    <span class="review-form__value">{{$reservation->reservation_date}}</span>
                    <span class="review-form__value">{{$reservation->formatted_time}}</span>
                </div>
                <div>
                    <p class="review-form__label">来店人数</p>
                    <span class="review-form__value">{{$reservation->member_count}}人</span>
                </div>
                <div>
                    <p class="review-form__label">評価<span class="review-form__label--required">必須</span></p>
                    <select class="review-form__value" name="rating">
                        <option value="5">5（とても良い）</option>
                        <option value="4">4（良い）</option>
                        <option value="3">3（普通）</option>
                        <option value="2">2（悪い）</option>
                        <option value="1">1（とても悪い）</option>
                    </select>
                    <div class="error-message">
                        @error('rating')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div>
                    <p class="review-form__label">コメント<span class="review-form__label--required">必須</span></p>
                    <div class="error-message">
                        @error('comment')
                        {{ $message }}
                        @enderror
                    </div>
                    <textarea name="comment" cols="50" rows="5">{{ old('comment') }}</textarea>

                </div>
                <div class="review-form__error">
                    @error('name')
                    {{ $message }}
                    @enderror
                </div>
                <div class="review-form__button-area">
                    <input type="hidden" name="reservation_id" value="{{$reservation->id}}">
                    <button class="review-form__button" type="submit">評価する</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection