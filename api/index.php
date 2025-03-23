<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// メンテナンスモードの確認
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Composerのオートローダーを読み込む
require __DIR__.'/../vendor/autoload.php';

// Laravelアプリケーションの初期化
/** @var Application $app */
$app = require_once __DIR__.'/../bootstrap/app.php';

// リクエストを処理し、レスポンスを返す
$response = $app->make(Illuminate\Contracts\Http\Kernel::class)->handle(
    $request = Request::capture()
);

// レスポンスを出力
$response->send();

// Laravelの終了処理
$app->make(Illuminate\Contracts\Http\Kernel::class)->terminate($request, $response);
