<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LendingController;
use App\Http\Controllers\CsvController;


Route::get('/lendings', [LendingController::class, 'index'])->name('lendings.index');
Route::post('/lendings', [LendingController::class, 'store'])->name('lendings.store');
Route::put('/lendings/{id}', [LendingController::class, 'update'])->name('lendings.update');
Route::delete('/lendings/{id}', [LendingController::class, 'destroy'])->name('lendings.destroy');

Route::get('/lendings/confirm', [LendingController::class, 'confirm'])->name('lendings.confirm');
Route::get('/export-csv', [CsvController::class, 'export'])->name('export.csv');

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

require __DIR__.'/auth.php';
