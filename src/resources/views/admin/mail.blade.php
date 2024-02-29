@extends('layouts.app_admin')

@section('css')
<link rel="stylesheet" href="{{ asset('css/manager.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="content">
        <div class="shop__header">
            <h1>お知らせメールの作成</h1>
        </div>
        <form class="form" action="{{ url('/admin/mail') }}" method="post">
            @csrf
            <div class="form__group">
                <div class="form__item">
                    <p class="form__label">タイトル</p>
                    <input class="form__input" type="text" name="mail_subject"></input>
                </div>
                <div class="error-message error-message--margin">
                    @error('mail_subject')
                    {{ $message }}
                    @enderror
                </div>
                <div class="form__item">
                    <p class="form__label">本文</p>
                    <textarea class="form__textarea" name="mail_message" rows="10" columns="30"></textarea>
                </div>
                <div class="error-message error-message--margin">
                    @error('mail_message')
                    {{ $message }}
                    @enderror
                </div>
                <div class="form__button-area">
                    <button class="form__button" type="submit">送信する</button>
                </div>
        </form>
    </div>
</div>
@endsection