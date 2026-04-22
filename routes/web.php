<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/home', [ProductController::class, 'index'])->name('home');
    Route::get('/charge/{product}', [ProductController::class, 'charge'])->name('charge');
    Route::post('/process-payment/{product}', [ProductController::class, 'processPayment'])->name('processPayment');
});