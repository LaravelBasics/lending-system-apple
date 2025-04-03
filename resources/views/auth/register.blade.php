@extends('layouts.apptop')

@section('title', 'ユーザー登録画面')
@section('style')
<style>
    .container {
        max-width: 500px;
        padding: 20px;
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
</style>
@endsection

@section('content')
<div class="container">
    <h2 class="text-center mb-4">ユーザー登録</h2>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">ユーザー名</label>
            @error('name')
            <div class="text-danger">{{ $message }}</div>
            @enderror
            <input id="name" type="text" name="name" class="form-control" value="{{ old('name') }}" autofocus>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">メールアドレス</label>
            @error('email')
            <div class="text-danger">{{ $message }}</div>
            @enderror
            <input id="email" type="email" name="email" class="form-control" value="{{ old('email') }}">
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">パスワード</label>
            @error('password')
            <div class="text-danger">{{ $message }}</div>
            @enderror
            <input id="password" type="password" name="password" class="form-control">
        </div>

        <div class="mb-3">
            <label for="password-confirm" class="form-label">パスワード確認</label>
            @error('password_confirmation')
            <div class="text-danger">{{ $message }}</div>
            @enderror
            <input id="password-confirm" type="password" name="password_confirmation" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary w-100">登録</button>
    </form>
    <div class="mt-3 d-flex justify-content-center">
        <a href="{{ route('home') }}" class="btn btn-outline-secondary mx-2">戻る</a>
    </div>
</div>
@endsection