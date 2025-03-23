<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
//  元の設定2025/3/19
require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
/** @var Application $app */
$app = require_once __DIR__.'/../bootstrap/app.php';

$app->handleRequest(Request::capture());


// Vercelのサーバーレス関数のエントリーポイントとして機能するためのファイルapi/index.phpを作成します。以下
/**
* Here is the serverless function entry
* for deployment with Vercel.
*/
// require __DIR__.'/../public/index.php';