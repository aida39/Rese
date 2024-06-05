@extends('layouts.app_admin')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/manager.css') }}">
@endsection

@section('content')
    <div class="container">
        <div class="content">
            <div class="shop__header">
                <h1>csvインポート</h1>
            </div>
            <form action="/admin/import" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form__group">
                    @if (session('flash-message'))
                        <div class="message">
                            {{ session('flash-message') }}
                        </div>
                    @endif
                    <div class="import__input-area">
                        <input type="file" name="csvFile" class="" id="csvFile">
                    </div>
                    <div class="error-message">
                        @if ($errors->any())
                                @foreach ($errors->all() as $error)
                                    <p>{{ $error }}</p>
                                @endforeach
                        @endif
                    </div>
                    <button class="form__button">インポート</button>

                </div>
            </form>
        </div>
    </div>
@endsection
