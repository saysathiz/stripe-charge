<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


// Route::get('/', [App\Http\Controllers\ProductController::class,'index']);
Auth::routes();

Route::get('/home', [App\Http\Controllers\ProductController::class, 'index'])->name('home');

Route::get('/charge/{product_id}', [App\Http\Controllers\ProductController::class,'charge']);

Route::post('/process-payment/{string}/{price}', [App\Http\Controllers\ProductController::class, 'processPayment'])->name('processPayment');
