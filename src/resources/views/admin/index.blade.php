@extends('layouts.app_admin')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="register__container">
    <div class="register__content">
        <div class="register__header">
            <h1>店舗代表者の作成</h1>
        </div>
        <form class="register-form" action="/admin/register" method="post">
            @csrf
            <div class="register-form__group">
                <div class="register-form__input-area">
                    <img src="/images/username.jpg" alt="name">
                    <input class="register-form__input" type="text" name="name" value="{{ old('name') }}" placeholder="name" />
                </div>
                <div class="error-message error-message--margin-left">
                    @error('name')
                    {{ $message }}
                    @enderror
                </div>
                <div class="register-form__input-area">
                    <img src="/images/email.jpg" alt="email">
                    <input class="register-form__input" type="email" name="email" value="{{ old('email') }}" placeholder="Email" />
                </div>
                <div class="error-message error-message--margin-left">
                    @error('email')
                    {{ $message }}
                    @enderror
                </div>
                <div class="register-form__input-area">
                    <img src="/images/password.jpg" alt="password">
                    <input class="register-form__input" type="password" name="password" placeholder="Password" />
                </div>
                <div class="error-message error-message--margin-left">
                    @error('password')
                    {{ $message }}
                    @enderror
                </div>
                @if(session('error-message'))
                <div class="error-message error-message--margin-left">
                    {{ session('error-message') }}
                </div>
                @endif
            </div>
            <div class="register-form__button-area">
                <button class="register-form__button" type="submit">作成する</button>
            </div>
        </form>
    </div>
</div>
@endsection