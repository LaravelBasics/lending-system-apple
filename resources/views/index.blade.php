@extends('layouts.apptop')

@section('title', 'トップページ')

@section('style')
<style>
    .wrapper {
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 80vw;
    }

    .image-row {
        display: flex;
        justify-content: space-between;
        width: 100%;
        max-width: 1200px;
        margin-bottom: 1rem;
    }

    .image {
        width: 150px;
        /* 画像のサイズを固定（調整可能） */
        height: auto;
    }

    .container {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: white;
        padding: 1.5rem;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        text-align: center;
        max-width: 300px;
    }

    .image-row {
        display: flex;
        justify-content: space-evenly;
        width: 100%;
        max-width: 1200px;
        margin-bottom: 1rem;
    }

    .image {
        width: 150px;
        height: auto;
    }

    .image1 {
        flex: 1 0 30%;
    }

    .image2 {
        flex: 1 0 30%;
    }

    .image3 {
        flex: 1 0 30%;
    }


    @media (max-width: 1024px) {
        .image {
            width: 120px;
        }
    }

    @media (max-width: 768px) {
        .wrapper {
            width: 90vw;
        }

        .image {
            width: 100px;
        }
    }
</style>
@endsection

@section('content')
<div class="wrapper">
    <!-- 1段目 -->
    <div class="image-row">
        <div class="image"><img src="{{ asset('images/image1.png') }}" alt="画像1"></div>
        <div class="image"><img src="{{ asset('images/image2.png') }}" alt="画像2"></div>
        <div class="image"><img src="{{ asset('images/image3.png') }}" alt="画像3"></div>
        <div class="image"><img src="{{ asset('images/image4.png') }}" alt="画像4"></div>
        <div class="image"><img src="{{ asset('images/image5.png') }}" alt="画像5"></div>
    </div>

    <!-- 2段目（中央の画像とコンテンツ） -->
    <div class="image-row" style="margin: 3rem;">
        <div class="container">
            <h2 class="text-center mb-4">トップページ</h2>

            @auth
            <p class="text-center">ログイン中: {{ Auth::user()->name }}</p>
            @endauth

            <div class="d-flex justify-content-center">
                @auth
                <a href="{{ route('lendings.index') }}" class="btn btn-primary mx-2">備品管理ページ</a>
                @else
                <a href="{{ route('register') }}" class="btn btn-outline-primary mx-2">ユーザー登録</a>
                <a href="{{ route('login') }}" class="btn btn-outline-primary mx-2">ログイン</a>
                @endauth
            </div>
        </div>
    </div>

    <!-- 3段目 -->
    <div class="image-row">
        <div class="image"><img src="{{ asset('images/image6.png') }}" alt="画像6"></div>
        <div class="image"><img src="{{ asset('images/image7.png') }}" alt="画像7"></div>
        <div class="image"><img src="{{ asset('images/image8.png') }}" alt="画像8"></div>
        <div class="image"><img src="{{ asset('images/image9.png') }}" alt="画像9"></div>
        <div class="image"><img src="{{ asset('images/image10.png') }}" alt="画像10"></div>
    </div>
</div>
@endsection