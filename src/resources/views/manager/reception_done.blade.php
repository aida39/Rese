@extends('layouts.app_manager')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('content')
<div class="thanks__container">
    <div class="thanks__content">
        <p class="thanks__message">来店確認が完了しました</p>
        <div class="thanks__button-area">
            <a class="thanks__button" href="/manager/index">戻る</a>
        </div>
    </div>
</div>
@endsection