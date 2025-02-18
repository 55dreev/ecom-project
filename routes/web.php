<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');  // The homepage before login
Route::view('/login', 'login')->name('login');      
Route::view('/signup', 'signup')->name('signup');  // Signup page
Route::view('/homepage', 'homepage')->name('homepage');

Route::post('/signup', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');  