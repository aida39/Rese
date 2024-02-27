@extends('layouts.app_manager')

@section('css')
<link rel="stylesheet" href="{{ asset('css/manager.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="content">
        <div class="shop__header">
            <h1>店舗情報の作成</h1>
        </div>
        <form class="form" action="store" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form__group">
                <div class="form__item">
                    <p class="form__label">飲食店名</p>
                    <input class="form__input" type="text" name="shop_name" value="{{ old('shop_name') }}"></input>
                </div>
                <div class="error-message error-message--margin">
                    @error('shop_name')
                    {{ $message }}
                    @enderror
                </div>
                <div class="form__item">
                    <p class="form__label">店舗画像</p>
                    <input class="form__input form__input--small" type="file" name="image" id="input-file-01" onchange="previewImage(event)">
                    <div class="form__select-button">
                        <button id="bt-file-01" type="button">ファイルを選択</button>
                        <span id="output-01" class="output"></span>
                    </div>
                </div>
                <div id="imagePreview" class="image-preview"></div>
                <div class="error-message error-message--margin">
                    @error('image')
                    {{ $message }}
                    @enderror
                </div>
                <div class="form__item">
                    <p class="form__label">エリア</p>
                    <select class="form__input" name="shop_area_id">
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
                <div class="form__item">
                    <p class="form__label">ジャンル</p>
                    <select class="form__input" name="shop_genre_id">
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
                <div class="form__item">
                    <p class="form__label">説明</p>
                    <textarea class="form__textarea" name="shop_description" rows="10" columns="30">{{ old('shop_description') }}</textarea>
                </div>
                <div class="error-message error-message--margin">
                    @error('shop_description')
                    {{ $message }}
                    @enderror
                </div>
                <div class="form__button-area">
                    <button class="form__button" type="submit">作成する</button>
                </div>
        </form>
    </div>
</div>
<script src="{{ asset('js/image-preview.js') }}"></script>
<script src="{{ asset('js/file-select.js') }}"></script>
@endsection