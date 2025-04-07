@extends('layouts.apptop')

@section('title', 'ログインフォーム')

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
    <h2 class="text-center mb-4">ログイン</h2>

    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label" for="email">メールアドレス</label>
            <input id="email" class="form-control" name="email" type="email" value="{{ old('email') }}" required autofocus />
            @error('email')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label" for="password">パスワード</label>
            <input id="password" class="form-control" name="password" type="password" required />
            @error('password')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3 form-check">
            <input id="remember" class="form-check-input" name="remember" type="checkbox" />
            <label class="form-check-label" for="remember">ログイン情報を記憶する</label>
        </div>
        <button class="btn btn-primary w-100" type="submit">ログイン</button>
    </form>
    <div class="mt-3 d-flex justify-content-center">
        <a href="{{ route('home') }}" class="btn btn-outline-secondary mx-2">戻る</a>
    </div>
    <small class="mt-2 d-block" style="text-align: center;"><a href="{{ route('password.request') }}">パスワードをお忘れの方</a></small>
</div>
@endsection