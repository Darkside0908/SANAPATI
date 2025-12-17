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
    return view('dashboard'); // Ensure this view exists or return text
})->name('dashboard');

Route::get('/bantuan', function () {
    return view('bantuan'); // Ensure this view exists
})->name('help');

Route::get('/login', function () {
    return view('masuk'); // Ensure this view exists
})->name('login');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/bantuan', function () {
    return view('bantuan');
})->name('help');

Route::get('/masuk', function () {
    return view('masuk');
})->name('login');

// API Routes
Route::prefix('api')->group(function () {
    Route::get('/tree', [TreeController::class, 'index'])->name('api.tree');
});

