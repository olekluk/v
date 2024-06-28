<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\LocalLicenseController;
use App\Http\Controllers\VerifyController;
use App\Http\Controllers\StatsController;


use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/verify', [VerifyController::class, 'index'])->name('verify');

Route::middleware('auth')->group(function () {
    Route::post('/info-search', [InfoController::class, 'search'])->name('info.search');
    Route::get('/info-all', [InfoController::class, 'all'])->name('info.all');
    Route::post('/deactivate', [InfoController::class, 'deactivate'])->name('deactivate');

    Route::get('/local', [LocalLicenseController::class, 'index'])->name('local.index');
    Route::post('/local-add', [LocalLicenseController::class, 'add'])->name('local.add');
    Route::post('/local-delete', [LocalLicenseController::class, 'delete'])->name('local.delete');

    Route::get('/stats-skin', [StatsController::class, 'skin'])->name('stats.skin');
    Route::get('/stats-sales', [StatsController::class, 'sales'])->name('stats.sales');
});

require __DIR__ . '/auth.php';
