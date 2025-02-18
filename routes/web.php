<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');
Route::view('/login', 'login');
Route::view('/signup', 'signup');

Route::post('/signup', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');
