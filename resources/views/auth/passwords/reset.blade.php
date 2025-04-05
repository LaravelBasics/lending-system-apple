@extends('layouts.apptop')

@section('title', 'パスワードリセット')

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
<form method="POST" action="{{ route('password.update') }}">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">
    <input type="hidden" name="email" value="{{ $email }}">

    <!-- <div>
        <label for="email">メールアドレス</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
    </div> -->

    <div class="mb-3">
        <label class="form-label" for="password">新しいパスワード</label>
        <input id="password" class="form-control" type="password" name="password" required>
    </div>

    <div class="mb-3">
        <label class="form-label" for="password_confirmation">パスワード確認</label>
        <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required>
    </div>

    <!-- @error('email')
    <div>{{ $message }}</div>
    @enderror -->

    @error('password')
    <div class="mb-3" style="color: #dc3545; font-weight: bold;">{{ $message }}</div>
    @enderror

    <button class="btn btn-primary w-100" type="submit">
        パスワードをリセット
    </button>
</form>
</div>
@endsection