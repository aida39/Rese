@extends('layouts.app')

@section('css')
    {{-- <link rel="stylesheet" href="{{ asset('css/index.css') }}"> --}}

    <link rel="stylesheet" href="{{ asset('css/review.css') }}">
@endsection

@section('content')
    <div class="review__container">
        <div class="left__container">
            <div class="review__header">
                <h1>今回のご利用はいかがでしたか？</h1>
            </div>
            <div class="review__body">
                <div class="shop__card">
                    <div class="shop__card-img">
                        <img src="{{ asset($shop->image_path) }}" alt="shop_image {{ $shop['shopGenre']['shop_genre'] }}">
                    </div>
                    <div class="shop__card-text">
                        <p class="shop__title">{{ $shop['shop_name'] }}</p>
                        <span class="shop__info">#{{ $shop['shopArea']['shop_area'] }}</span>
                        <span class="shop__info">#{{ $shop['shopGenre']['shop_genre'] }}</span>
                        <div class="shop__unit">
                            <a href="/shop/detail?id={{ $shop['id'] }}" class="shop__detail">詳しくみる</a>
                            @if (Auth::check())
                                <div>
                                    <form action="{{ url('/favorite/' . $shop['id']) }}" method="post">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="shop_id" value="{{ $shop['id'] }}">
                                        <button type="submit" class="shop__favorite">
                                            <i
                                                class="fa-solid fa-heart {{ $shop->favorite->where('user_id', Auth::id())->count() > 0 ? 'shop__favorite--red' : 'shop__favorite--gray' }}"></i>
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr class="hr">

        <div class="right__container">
            <div class="review__header">
                <h1></h1>
            </div>
            <form class="review-form" action="/review" method="post">
                @csrf
                <div class="review-form__group">
                    <div>
                        <p class="review-form__label">体験を評価してください</p>
                        <select class="review-form__value" name="rating">
                            <option value="5" {{ old('rating') == '5' ? 'selected' : '' }}>5（とても良い）</option>
                            <option value="4" {{ old('rating') == '4' ? 'selected' : '' }}>4（良い）</option>
                            <option value="3" {{ old('rating') == '3' ? 'selected' : '' }}>3（普通）</option>
                            <option value="2" {{ old('rating') == '2' ? 'selected' : '' }}>2（悪い）</option>
                            <option value="1" {{ old('rating') == '1' ? 'selected' : '' }}>1（とても悪い）</option>
                        </select>
                    </div>
                    <div class="error-message">
                        @error('rating')
                            {{ $message }}
                        @enderror
                    </div>
                    <div>
                        <p class="review-form__label">口コミを投稿</p>
                        <textarea class="review-form__text" name="comment" cols="50" rows="5" placeholder="カジュアルな夜のお出かけにおすすめのスポット">{{ old('comment') }}</textarea>
                    </div>
                    <div class="error-message">
                        @error('comment')
                            {{ $message }}
                        @enderror
                    </div>
                    <div>
                        <p class="review-form__label">画像の追加</p>
                        <input type="file" name="image" class="review-form__image">
                    </div>
                    <div class="error-message">
                        @error('image')
                            {{ $message }}
                        @enderror
                    </div>
                    <div class="review-form__button-area">
                        <button class="review-form__button" type="submit">押さない</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="review-form__button-area">
        <button class="review-form__button" type="button">口コミを投稿</button>
    </div>
@endsection
