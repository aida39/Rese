@extends('layouts.app_manager')

@section('css')
<link rel="stylesheet" href="{{ asset('css/manager.css') }}">
@endsection

@section('content')
<div class="container">
    <h1 class="title">店舗情報の作成</h1>
    <form action="store" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-item">
            <span>店名</span>
            <input class="form-item__input" type="text" name="shop_name" value="{{ old('shop_name') }}"></input>
        </div>
        <div class="error-message error-message--margin">
            @error('shop_name')
            {{ $message }}
            @enderror
        </div>
        <div class="form-item">
            <span>店舗画像</span>
            <input class="form-item__input form-item__input--small" type="file" name="image" id="image" onchange="previewImage(event)">
        </div>
        <div id="imagePreview" class="image-preview"></div>
        <div class="error-message error-message--margin">
            @error('image')
            {{ $message }}
            @enderror
        </div>
        <div class="form-item">
            <span>エリア</span>
            <select class="form-item__input" name="shop_area_id">
                @foreach($shop_areas as $shop_area)
                <option value="{{ $shop_area->id }}" {{ old('shop_area_id') == $shop_area->id ? 'selected' : '' }}>{{ $shop_area->shop_area }}</option>
                @endforeach
            </select>
        </div>
        <div class="error-message error-message--margin">
            @error('shop_area_id')
            {{ $message }}
            @enderror
        </div>
        <div class="form-item">
            <span>ジャンル</span>
            <select class="form-item__input" name="shop_genre_id">
                @foreach($shop_genres as $shop_genre)
                <option value="{{ $shop_genre->id }}" {{ old('shop_genre_id') == $shop_genre->id ? 'selected' : '' }}>{{ $shop_genre->shop_genre }}</option>
                @endforeach
            </select>
        </div>
        <div class="error-message error-message--margin">
            @error('shop_genre_id')
            {{ $message }}
            @enderror
        </div>
        <div class="form-item">
            <span>説明</span>
            <textarea class="form-item__textarea" name="shop_description" rows="10" columns="30">{{ old('shop_description') }}</textarea>
        </div>
        <div class="error-message error-message--margin">
            @error('shop_description')
            {{ $message }}
            @enderror
        </div>
        <button class="form-item__button" type="submit">作成する</button>
    </form>
</div>
<script src="{{ asset('js/image-preview.js') }}"></script>
@endsection