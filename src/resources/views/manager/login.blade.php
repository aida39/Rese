@extends('layouts.app_manager')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
<div class="login__container">
    <div class="login__content">
        <div class="login__header">
            <h1>Login for Managers</h1>
        </div>
        <form class="login-form" action="/manager/login" method="post">
            @csrf
            <div class="login-form__group">
                <div class="login-form__input-area">
                    <img src="/images/email.png" alt="email">
                    <input class="login-form__input" type="email" name="email" value="{{ old('email') }}" placeholder="Email" />
                </div>
                <div class="error-message">
                    @error('email')
                    {{ $message }}
                    @enderror
                </div>
                <div class="login-form__input-area">
                    <img src="/images/password.png" alt="password">
                    <input class="login-form__input" type="password" name="password" placeholder="Password" />
                </div>
                <div class="error-message">
                    @error('password')
                    {{ $message }}
                    @enderror
                </div>
                <div class="login-form__button-area">
                    <button class="login-form__button" type="submit">ログイン</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection