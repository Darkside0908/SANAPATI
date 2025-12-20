<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TreeController;

// Pages
Route::get('/', function () {
    return view('landing');
})->name('home');

Route::get('/pohon-kinerja', function () {
    return view('pohon_kinerja');
})->name('tree');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/bantuan', function () {
    return view('bantuan');
})->name('help');

// API Routes
Route::prefix('api')->group(function () {
    Route::get('/tree', [TreeController::class, 'index'])->name('api.tree');
});
