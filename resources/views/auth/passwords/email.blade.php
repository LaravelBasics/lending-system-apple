@extends('layouts.apptop')

@section('title', 'パスワード再設定')

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
    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label" for="email">メールアドレス</label>
            <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required autofocus>
        </div>

        @if (session('status'))
        <div class="text-danger mb-2" style="font-weight: bold;">{{ session('status') }}</div>
        @endif

        <button class="btn btn-primary w-100" type="submit">パスワード再設定メールを送信</button>
        <div class="mt-1">※テスト用のため<span style="color: #28a745; font-weight: bold;">メールは「管理者」に送信</span>されます</div>
        <div class="mt-3 d-flex justify-content-center"><a href="{{ route('login') }}" class="btn btn-outline-secondary">戻る</a></div>
    </form>
</div>
@endsection