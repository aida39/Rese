@extends('layouts.app_manager')

@section('css')
<link rel="stylesheet" href="{{ asset('css/manager.css') }}">
@endsection

@section('content')

<div class="admin__shop-area">
    <form action="store" method="post">
        @csrf
        <div class="form-item">
            <span>店名</span>
            <input class="form-item__input" type="text" name="shop_name" value="{{ old('shop_name') }}"></input>
        </div>
        <div class="error-message">
            @error('shop_name')
            {{ $message }}
            @enderror
        </div>
        <div class="form-item">
            <span>エリア</span>
            <select class="form-item__input" name="shop_area_id">
                @foreach($shop_areas as $shop_area)
                <option value="{{$shop_area->id}}">{{$shop_area->shop_area}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-item">
            <span>ジャンル</span>
            <select class="form-item__input" name="shop_genre_id">
                @foreach($shop_genres as $shop_genre)
                <option value="{{$shop_genre->id}}">{{$shop_genre->shop_genre}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-item">
            <span>説明</span>
            <textarea class="form-item__textarea" name="shop_description" rows="10" columns="30" >{{ old('shop_description') }}</textarea>
        </div>
        <div class="error-message">
            @error('shop_description')
            {{ $message }}
            @enderror
        </div>
        <button class="form-item__button" type="submit">作成する</button>
    </form>
</div>
@endsection