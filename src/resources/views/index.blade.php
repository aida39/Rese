@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('search')
<div class="search__content">
    <form class="search__content__form" action="/search" method="get">
        @csrf
        <div class="search__content__inner">
            <select class="search__area-box" name="shop_area_id">
                <option value="">All area</option>
                @foreach ($shop_areas as $shop_area)
                <option value="{{ $shop_area['id'] }}">{{ $shop_area['shop_area'] }}</option>
                @endforeach
            </select>
            <select class="search__genre-box" name="shop_genre_id">
                <option value="">All genre</option>
                @foreach ($shop_genres as $shop_genre)
                <option value="{{ $shop_genre['id'] }}">{{ $shop_genre['shop_genre'] }}</option>
                @endforeach
            </select>
            <button class="search__button" type="submit">
                <img src="/images/search.png">
            </button>
            <input class="search__input" type="search" name="keyword" placeholder="Search…" value="{{ old('keyword') }}">
        </div>
    </form>
</div>
@endsection

@section('content')
<div class="shop__content">
    <div class="shop__content__inner">
        @foreach ($shops as $shop)
        <div class="shop__card">
            <div class="shop__card-img">
                <img src="{{ asset($shop->image_path) }}" alt="shop_image {{ $shop['shopGenre']['shop_genre'] }}">
            </div>
            <div class="shop__card-text">
                <p class="shop__title">{{ $shop['shop_name'] }}</p>
                <span class="shop__info">#{{ $shop['shopArea']['shop_area'] }}</span>
                <span class="shop__info">#{{ $shop['shopGenre']['shop_genre'] }}</span>
                <div class="shop__unit">
                    <a href="shop/detail?id={{$shop['id']}}" class="shop__detail">詳しくみる</a>
                    @if (Auth::check() )
                    <div>
                        <form action="{{ url('/favorite/'.$shop['id']) }}" method="post">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="shop_id" value="{{ $shop['id'] }}">
                            <button type="submit" class="shop__favorite">
                                <i class="fa-solid fa-heart {{ $shop->favorite->where('user_id', Auth::id())->count() > 0 ? 'shop__favorite--red' : 'shop__favorite--gray' }}"></i>
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
@endsection