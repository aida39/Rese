@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/review.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.10/vue.min.js"></script>
    <script src="https://unpkg.com/vue-star-rating@1.6.3/dist/star-rating.min.js"></script>
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
                        <div id="app">
                            <p class="review-form__label">体験を評価してください</p>
                            <star-rating active-color="#3560f6" v-bind:star-size="45" :show-rating="false"></star-rating>
                        </div>
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
                    <div id="upFileWrap">
                        <p class="review-form__label">画像の追加</p>
                        <div id="inputFile">
                            <p id="dropArea">クリックして写真を追加<br>またはドラッグアンドドロップ</p>
                            <div id="inputFileWrap">
                                <input type="file" name="uploadFile" id="uploadFile" class="review-form__image">
                                <div id="btnInputFile"><span>ファイルを選択する</span></div>
                            </div>
                        </div>
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

    <script>
        const StarRating = window.VueStarRating.default;

        Vue.component('star-rating', StarRating);
        let app = new Vue({
            el: '#app',
            data: {
                rating: 0,
            }
        });
    </script>
    <script src="{{ asset('js/drag-and-drop.js') }}"></script>
@endsection
