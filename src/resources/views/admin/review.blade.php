@extends('layouts.app_admin')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/detail.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.10/vue.min.js"></script>
    <script src="https://unpkg.com/vue-star-rating@1.6.3/dist/star-rating.min.js"></script>
@endsection

@section('content')
    <div class="container">
        <hr class="hr">
        @forelse ($reviews as $review)
            <div class="review__card">
                <div class="review__title">
                    <form class="review__delete-form" action="/admin/delete/review/{{ $review['id'] }}" method="post">
                        @csrf
                        <input type="hidden" name="review_id" value="{{ $review['id'] }}">
                        <button type="submit" class="review__delete-button"
                            onclick="confirmAction(event, 'この口コミを削除しますか？');">
                            口コミを削除
                        </button>
                    </form>
                </div>
                <div id="app">
                    <span class="review-form__label">飲食店名:</span>
                    <span class="review-form__value">{{ $review->reservation->shop->shop_name }}</span><br>
                    <span class="review-form__label">レビュアー名:</span>
                    <span class="review-form__value">{{ $review->reservation->user->name }}</span>
                    <star-rating active-color="#3560f6" v-bind:star-size="35" v-model="rating" :show-rating="false"
                        :read-only="true" @rating-selected ="setRating"></star-rating>
                    <p class="review__rating">{{ $review->rating }}</p>
                </div>
                <p class="review__text">{{ $review->comment }}</p>
                <div>
                    <img class="review__image" src="{{ asset($review->image_path) }}" alt="Review Image">
                </div>
            </div>
            <hr class="hr">
        @empty
            <p>口コミはまだありません</p>
        @endforelse
    </div>
    <script src="{{ asset('js/show-reservation.js') }}"></script>
    <script src="{{ asset('js/confirmation-window.js') }}"></script>
    <script src="https://checkout.stripe.com/checkout.js"></script>
    <script>
        var stripeKey = "{{ env('STRIPE_KEY') }}";
    </script>
    <script src="{{ asset('js/stripe-payment.js') }}"></script>
    <script>
        const StarRating = window.VueStarRating.default;

        Vue.component('star-rating', StarRating);
        let app = new Vue({
            el: '#app',
            methods: {
                setRating: function(rating) {
                    this.rating = rating;
                }
            },
            data: {
                rating: {{ $review->rating ?? 0 }}
            }
        });
    </script>
@endsection
