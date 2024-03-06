@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="container-inner">
        <div class="left-wrapper shop-detail__content">
            <div class="shop-detail__title">
                <a href="/" class="shop-detail__link">&lt;</a>
                <h1 class="shop-detail__name">{{ $shop['shop_name'] }}</h1>
            </div>
            <div class="shop-detail__img">
                <img src="{{ asset($shop->image_path) }}" alt="Shop Image {{ $shop['shopGenre']['shop_genre'] }}">
            </div>
            <div class="shop-detail__text">
                <span>#{{ $shop['shopArea']['shop_area'] }}</span>
                <span>#{{ $shop['shopGenre']['shop_genre'] }}</span>
                <p class="">{{ $shop['shop_description'] }}</p>
            </div>
        </div>
        <div class="right-wrapper reservation__content">
            <h2 class="reservation__title">予約</h2>
            @if (Auth::check())
            <form class="form" id="reservationForm" action="/reservation/create" method="post">
                @csrf
                <div class="reservation__input-field">
                    <input type="date" name="reservation_date" value="{{ old('reservation_date', date('Y-m-d')) }}" id="reservationDate">
                    <div class="error-message error-message--white">
                        @error('reservation_date')
                        {{ $message }}
                        @enderror
                    </div>
                    <select name="reservation_time" id="reservationTime">
                        <option value="17:00:00" {{ old('reservation_time') == '17:00:00' ? 'selected' : '' }}>17:00</option>
                        <option value="17:30:00" {{ old('reservation_time') == '17:30:00' ? 'selected' : '' }}>17:30</option>
                        <option value="18:00:00" {{ old('reservation_time') == '18:00:00' ? 'selected' : '' }}>18:00</option>
                        <option value="18:30:00" {{ old('reservation_time') == '18:30:00' ? 'selected' : '' }}>18:30</option>
                        <option value="19:00:00" {{ old('reservation_time') == '19:00:00' ? 'selected' : '' }}>19:00</option>
                        <option value="19:30:00" {{ old('reservation_time') == '19:30:00' ? 'selected' : '' }}>19:30</option>
                        <option value="20:00:00" {{ old('reservation_time') == '20:00:00' ? 'selected' : '' }}>20:00</option>
                        <option value="20:30:00" {{ old('reservation_time') == '20:30:00' ? 'selected' : '' }}>20:30</option>
                        <option value="21:00:00" {{ old('reservation_time') == '21:00:00' ? 'selected' : '' }}>21:00</option>
                    </select>
                    <div class="error-message error-message--white">
                        @error('reservation_time')
                        {{ $message }}
                        @enderror
                    </div>
                    <select name="member_count" id="reservationPeople">
                        <option value="1" {{ old('member_count') == '1' ? 'selected' : '' }}>1人</option>
                        <option value="2" {{ old('member_count') == '2' ? 'selected' : '' }}>2人</option>
                        <option value="3" {{ old('member_count') == '3' ? 'selected' : '' }}>3人</option>
                        <option value="4" {{ old('member_count') == '4' ? 'selected' : '' }}>4人</option>
                        <option value="5" {{ old('member_count') == '5' ? 'selected' : '' }}>5人</option>
                    </select>
                    <div class="error-message error-message--white">
                        @error('member_count')
                        {{ $message }}
                        @enderror
                    </div>
                    <select name="course_id" id="reservationCourse">
                        @foreach($courses as $course)
                        <option value="{{ $course->id }}" data-course="{{ $course->course }}" data-price="{{ $course->price }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>
                            {{ $course->course }}コース
                        </option>
                        @endforeach
                    </select>
                    <input type="hidden" id="courseName_{{ $course->id }}" value="{{ $course->course }}">
                    <input type="hidden" id="coursePrice_{{ $course->id }}" value="{{ $course->price }}">
                    <div class="error-message error-message--white">
                        @error('member_count')
                        {{ $message }}
                        @enderror
                    </div>
                    <input type="hidden" name="shop_id" value="{{ $shop['id'] }}">

                </div>
                <div class="reservation__confirm-field" id="confirmField">
                    <span id="storeName" data-name="{{ $shop['shop_name'] }}"></span>
                </div>
                <div class="reservation-button__area">
                    <button class="reservation-button" type="button" onclick="openStripeCheckout()">決済画面に進む</button>
                </div>
            </form>
            @else
            <div class="login__field">
                <div class="login__field-inner">
                    <div class="login__field__item">
                        <p class="login__field__message">IDをお持ちの方</p>
                        <a href="/login" class="login__field__link">ログインして予約する</a>
                    </div>
                    <div class="login__field__item">
                        <p class="login__field__message">IDをお持ちでない方</p>
                        <a href="/register" class="login__field__link">会員登録して予約する</a>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
    <div class="review__content">
        <h2>口コミ</h2>
        @if($reviews->isEmpty())
        <p>口コミはまだありません</p>
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
<script src="{{ asset('js/show-reservation.js') }}"></script>
<script src="https://checkout.stripe.com/checkout.js"></script>
<script>
    var stripeKey = "{{ env('STRIPE_KEY') }}";
</script>
<script src="{{ asset('js/stripe-payment.js') }}"></script>

<!-- <script>
    function openStripeCheckout() {
        var courseSelect = document.getElementById('reservationCourse');
        var selectedOption = courseSelect.options[courseSelect.selectedIndex];
        var coursePrice = parseFloat(selectedOption.dataset.price);
        var memberCount = parseInt(document.getElementById('reservationPeople').value); // 予約人数を取得して整数に変換

        if (isNaN(coursePrice) || isNaN(memberCount)) {
            alert('金額または人数が不正です');
            return;
        }

        var amount = coursePrice * memberCount; // 金額を計算

        var handler = StripeCheckout.configure({
            key: "{{ env('STRIPE_KEY') }}",
            image: "https://stripe.com/img/documentation/checkout/marketplace.png",
            locale: "auto",
            currency: "JPY",
            name: "Stripe決済デモ",
            description: "これはデモ決済です",
            amount: amount,
            token: function(token) {
                alert('支払いが成功しました。');
            }
        });

        handler.open({
            name: "Stripe決済画面（デモ）",
            description: "支払いが完了すると予約が確定します",
            amount: amount
        });
    }
</script> -->
@endsection