<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LendingController;
use App\Http\Controllers\CsvController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;

// トップページのルート
Route::get('/', [HomeController::class, 'index'])->name('home');

// ダッシュボードのルート（ログインが必要）
Route::get('/dashboard', [HomeController::class, 'dashboard'])->middleware('auth')->name('dashboard');

// ユーザー登録のルート
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register')->middleware('guest');
Route::post('register', [RegisterController::class, 'register']);

// ログインのルート
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);

// ログアウトのルート
Route::post('logout', [LogoutController::class, 'logout'])->name('logout');


// ログイン必須の貸出管理ルート
Route::middleware(['auth'])->group(function () {
    Route::get('/lendings', [LendingController::class, 'index'])->name('lendings.index');
    Route::post('/lendings', [LendingController::class, 'store'])->name('lendings.store');
    Route::get('/export-csv', [CsvController::class, 'export'])->name('export.csv');
    Route::get('/lendings/confirm', [LendingController::class, 'confirm'])->name('lendings.confirm');
    Route::put('/lendings/{id}', [LendingController::class, 'update'])->name('lendings.update');
    Route::delete('/lendings/{id}', [LendingController::class, 'destroy'])->name('lendings.destroy');
});


// Route::get('/lendings', [LendingController::class, 'index'])->name('lendings.index');
// Route::post('/lendings', [LendingController::class, 'store'])->name('lendings.store');
// Route::put('/lendings/{id}', [LendingController::class, 'update'])->name('lendings.update');
// Route::delete('/lendings/{id}', [LendingController::class, 'destroy'])->name('lendings.destroy');

// Route::get('/lendings/confirm', [LendingController::class, 'confirm'])->name('lendings.confirm');
// Route::get('/export-csv', [CsvController::class, 'export'])->name('export.csv');


use App\Models\Lending;
use Illuminate\Http\Request;

Route::get('/search', function (Request $request) {
    // クエリパラメータ 'q' を取得（ユーザーの検索入力）
    $query = $request->query('q');
    $column = $request->query('column'); // 'name' または 'item_name' など
    // クエリが空なら空の配列を返す（全件取得せず負荷を軽減）
    if (!$query) {
        return response()->json([]);
    }

    $allowedColumns = ['name', 'item_name']; // 許可されたカラム名のリスト

    // カラム名が許可リストに含まれていない場合、検索を実行せずに空の結果を返す
    if (!in_array($column, $allowedColumns)) {
        return response()->json([]); // 許可されていないカラムの場合は空の配列を返す
    }

    // カラム名が許可リストに含まれている場合のみ検索を実行
    $results = Lending::where($column, 'LIKE', "%{$query}%")
        ->select($column)
        ->groupBy($column)
        ->orderByRaw('MAX(id) DESC') // 最新データを優先
        ->get();

    // 結果をJSON形式で返す
    return response()->json($results);
});

// Route::get('/', function () {
//     return view('welcome');
// })->name('home');

// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

// Route::middleware(['auth'])->group(function () {
//     Route::redirect('settings', 'settings/profile');

//     Route::get('settings/profile', Profile::class)->name('settings.profile');
//     Route::get('settings/password', Password::class)->name('settings.password');
//     Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
// });

// require __DIR__ . '/auth.php';
