@extends('layouts.apptop')

@section('title', 'トップページ')

@section('style')
<style>
    .wrapper {
        display: flex;
        /* フレックスボックスで配置 */
        flex-direction: column;
        /* 子要素を縦に並べる */
        align-items: center;
        /* 子要素を左右中央に揃える */
        width: 80vw;
        /* ブラウザ幅の80%（レスポンシブ対応） */
    }

    /* 1段目と3段目のスライドアニメーション */
    .slide-container {
        width: 100%;
        /* 親要素いっぱいに広げる */
        margin: auto;
        /* 中央寄せ（横） */
        display: flex;
        /* 子要素を横並びにする */
        align-items: center;
        /* 高さ方向の中央揃え */
        overflow: hidden;
        /* スライドがはみ出た部分は非表示 */
        flex-direction: row;
        /* 横方向に子要素を並べる */
    }

    .slide-wrapper {
        flex-direction: row;
        /* 横並び */
        display: flex;
        animation: slide-flow 50s infinite linear 1s both;
        /* アニメーション名：slide-flow
       再生時間：50秒
       無限ループ：infinite
       速度一定：linear
       1秒遅延：1s
       開始・終了時のスタイル保持：both */
    }

    .slide {
        width: 200px;
        /* 画像の横幅 */
        margin-left: 16px;
        /* 左に少し余白を設ける */
        object-fit: cover;
        /* アスペクト比を保ちつつ枠に合わせる */
        border: 1px solid #ddd;
        /* 薄いグレーの枠線 */
    }

    @keyframes slide-flow {
        0% {
            transform: translateX(0);
            /* 初期位置：そのまま */
        }

        100% {
            transform: translateX(-200%);
            /* 左に200%移動（2セット分） */
            /* 6つの画像がスライドするので、-100%では足りない */
        }
    }

    /* 中央コンテンツ */
    .container {
        position: relative;
        /* 子要素の絶対位置指定が可能に */
        background: white;
        /* 背景は白 */
        padding: 1.5rem;
        /* 内側の余白 */
        border-radius: 10px;
        /* 角丸で柔らかい印象に */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        /* ふわっとした影を付ける */
        text-align: center;
        /* テキストを中央揃え */
        max-width: 300px;
        /* 最大幅300px（スマホでも整う） */
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
            @for ($i = 13; $i <= 18; $i++)
                <img class="slide" src="{{ asset("images/image{$i}.png") }}" alt="画像{{ $i }}">
                @endfor
        </div>
        <div class="slide-wrapper">
            @for ($i = 19; $i <= 24; $i++) <!-- ループのために2セット用意 -->
                <img class="slide" src="{{ asset("images/image{$i}.png") }}" alt="画像{{ $i }}">
                @endfor
        </div>
        <div class="slide-wrapper">
            @for ($i = 13; $i <= 18; $i++) <!-- ループのために2セット用意 -->
                <img class="slide" src="{{ asset("images/image{$i}.png") }}" alt="画像{{ $i }}">
                @endfor
        </div>
    </div>
</div>
@endsection