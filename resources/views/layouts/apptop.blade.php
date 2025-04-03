<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'タイトル')</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
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
    @yield('content')
</body>
</html>