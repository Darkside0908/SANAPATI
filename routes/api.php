<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Performance Tree Routes
Route::get('/pohon-kinerja/search', [\App\Http\Controllers\PerformanceController::class, 'search']);
Route::get('/pohon-kinerja', [\App\Http\Controllers\PerformanceController::class, 'index']);
Route::get('/pohon-kinerja/{code}', [\App\Http\Controllers\PerformanceController::class, 'show']);
