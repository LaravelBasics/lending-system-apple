<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'タイトル')</title>
    <link rel="icon" href="{{ asset('images/logo.ico') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
            width: 10rem;
            /* リングのサイズ */
            height: 10rem;
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

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f8f9fa;
        }

        body.admin {
            background-color: #f0f7ff;
        }

        .admin .container {
            background-color: #ffffff;
            box-shadow: 0 0 0.9375rem rgba(13, 110, 253, 0.2);
        }

        .form-label {
            font-weight: bold;
        }
    </style>
    @yield('style')
</head>

<body>
    <!-- ローディング画面 -->
    <div id="loading-screen">
        <div class="spinner"></div> <!-- 回転するリング -->
    </div>
    
    @yield('content')

    <script>
        // ページが完全に読み込まれたらローディング画面を非表示にする
        window.onload = function() {
            const loadingScreen = document.getElementById('loading-screen');
            loadingScreen.style.display = 'none'; // ローディング画面を非表示
        };
    </script>

    <!-- Vue 3 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/vue@3.3.0/dist/vue.global.prod.js"></script>
    @yield('script')
</body>

</html>