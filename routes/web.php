<?php

use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
Route::get('/product', [ReviewController::class, 'index'])->name('product');