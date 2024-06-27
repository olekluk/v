<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\VerifyController;


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

Route::get('/verify', [VerifyController::class, 'index'])->name('verify'); // api for theme
// Route::get('/check', 'VerifyController@check')->name('check'); // ????? don't understand why it needs. remove it?

Route::middleware('auth')->group(function () {

    Route::post('/info-search', [InfoController::class, 'search'])->name('info.search');
    Route::get('/info-all', [InfoController::class, 'all'])->name('info.all');
    Route::post('/deactivate', [InfoController::class, 'deactivate'])->name('deactivate');


    // Route::get('/test-db-connection', 'VerifyController@testDbConnection')->name('testdbconnection');

    // Route::get('/addforms', 'LocalLicenseController@addforms')->name('local.form');
    // Route::post('/addlocalcode', 'LocalLicenseController@addlocalcode')->name('local.add');
    // Route::get('/viewlocalcode', 'LocalLicenseController@viewlocalcode')->name('local.view');

    // Route::post('/addteststore', 'TestStoreController@addteststore')->name('test.add');
    // Route::get('/viewteststore', 'TestStoreController@viewteststore')->name('test.view');

    // Route::get('/skinstats', 'StatsController@skinstats')->name('stats.skin');
    // Route::get('/salepercustomer', 'StatsController@salepercustomer')->name('stats.sales');
});

require __DIR__ . '/auth.php';
