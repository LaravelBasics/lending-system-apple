<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'タイトル')</title>

    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.21/lodash.min.js"></script>
    <!-- 1. flatpickrのCSSとJSをCDNで読み込む -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script> <!-- flatpickr -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/ja.js"></script> <!-- 日本語ロケールの読み込み -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        /* ローディング画面 */
        #loading-screen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        /* リングのスタイル */
        .spinner {
            border: 0.5rem solid #f3f3f3;
            /* 薄い色 */
            border-top: 0.5rem solid #3498db;
            /* トップ部分の色 */
            border-radius: 50%;
            /* 円形にする */
            width: 3.125rem;
            /* リングのサイズ */
            height: 3.125rem;
            animation: spin 1s linear infinite;
            /* アニメーションの設定 */
        }

        /* 回転のアニメーション */
        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .error-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
        }

        /* Vue がマウントされるまで非表示にする */
        [v-cloak] {
            display: none;
        }
    </style>
    @yield('style')
</head>

<body>
    <!-- ローディング画面 -->
    <div id="loading-screen">
        <div class="spinner"></div> <!-- 回転するリング -->
    </div>
    <div id="app" v-cloak>
        <div v-if="isMobile" class="error-container">
            <h1>スマホ版は対応していません</h1>
        </div>

        <div v-else>
            @yield('content')
        </div>
    </div>

    <!-- Vue 3 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/vue@3.3.0/dist/vue.global.prod.js"></script>
    <!-- Axios CDN -->
    <script src="https://cdn.jsdelivr.net/npm/axios@1.4.0/dist/axios.min.js"></script>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // ページが完全に読み込まれたらローディング画面を非表示にする
        window.onload = function() {
            const loadingScreen = document.getElementById('loading-screen');
            loadingScreen.style.display = 'none'; // ローディング画面を非表示
        };
    </script>
    <!-- スクリプト用のセクション -->
    @yield('scripts')

</body>

</html>