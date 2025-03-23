<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <style>
        body {
            text-align: center;
            padding: 50px;
            font-family: Arial, sans-serif;
            background-color: #f8d7da;
            color: #721c24;
        }
        h1 { font-size: 50px; }
        p { font-size: 20px; }
    </style>
</head>
<body>
    <h1>@yield('code')</h1>
    <h1>@yield('message')</h1>
    @yield('content')
</body>
</html>
