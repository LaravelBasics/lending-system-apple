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

    /* 1段目と3段目のスライドアニメーション */
    .slide-container {
        width: 100%;
        margin: auto;
        display: flex;
        align-items: center;
        overflow: hidden;
        flex-direction: row;
    }

    .slide-wrapper {
        flex-direction: row;
        display: flex;
        animation: slide-flow 50s infinite linear 1s both;
    }

    .slide {
        width: 200px;
        margin-left: 16px;
        object-fit: cover;
        border: 1px solid #ddd;
    }

    @keyframes slide-flow {
        0% {
            transform: translateX(0);
        }

        100% {
            transform: translateX(-200%);
            /* 6つの画像がスライドするので、-100%では足りない */
        }
    }

    /* 中央コンテンツ */
    .container {
        position: relative;
        background: white;
        padding: 1.5rem;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        text-align: center;
        max-width: 300px;
    }
</style>
@endsection

@section('content')
<div class="wrapper">
    <!-- 1段目 (スライド) -->
    <div class="slide-container">
        <div class="slide-wrapper">
            @for ($i = 1; $i <= 6; $i++)
                <img class="slide" src="{{ asset("images/image{$i}.png") }}" alt="画像{{ $i }}">
                @endfor
        </div>
        <div class="slide-wrapper">
            @for ($i = 7; $i <= 12; $i++) <!-- ループのために2セット用意 -->
                <img class="slide" src="{{ asset("images/image{$i}.png") }}" alt="画像{{ $i }}">
                @endfor
        </div>
        <div class="slide-wrapper">
            @for ($i = 1; $i <= 6; $i++) <!-- ループのために2セット用意 -->
                <img class="slide" src="{{ asset("images/image{$i}.png") }}" alt="画像{{ $i }}">
                @endfor
        </div>
    </div>

    <!-- 2段目（中央のコンテンツ） -->
    <div class="container">
        <!-- <h2 class="text-center mb-4">トップページ</h2> -->
        <table style="border-collapse: collapse; margin: 0 auto;">
            <caption style="caption-side: top; text-align: center; font-weight: bold; font-size: 1.2rem;">
                テスト用アカウント
            </caption>
            <tr style="text-align: center;">
                <td style="padding: 0rem 1rem 0.25rem 0rem; text-align: left;">メールアドレス</td>
                <td style="padding: 0rem 0rem 0.25rem 0rem; text-align: left;">test@test</td>
            </tr>
            <tr style="text-align: center;">
                <td style="padding: 0rem 1rem 1rem 0rem; text-align: left;">パスワード</td>
                <td style="padding: 0rem 0rem 1rem 0rem; text-align: left;">testtest</td>
            </tr>
        </table>

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

    <!-- 3段目 (スライド) -->
    <div class="slide-container">
        <div class="slide-wrapper">
            @for ($i = 7; $i <= 12; $i++)
                <img class="slide" src="{{ asset("images/image{$i}.png") }}" alt="画像{{ $i }}">
                @endfor
        </div>
        <div class="slide-wrapper">
            @for ($i = 1; $i <= 6; $i++) <!-- ループのために2セット用意 -->
                <img class="slide" src="{{ asset("images/image{$i}.png") }}" alt="画像{{ $i }}">
                @endfor
        </div>
        <div class="slide-wrapper">
            @for ($i = 7; $i <= 12; $i++) <!-- ループのために2セット用意 -->
                <img class="slide" src="{{ asset("images/image{$i}.png") }}" alt="画像{{ $i }}">
                @endfor
        </div>
    </div>
</div>
@endsection