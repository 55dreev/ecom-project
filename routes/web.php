<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Homepage route (first page users see, before login)
Route::view('/', 'homepage')->name('homepage');  // Public homepage

// Authentication Routes (for login and signup)
Route::view('/login', 'login')->name('login');
Route::view('/signup', 'signup')->name('signup');  // Signup page

Route::post('/signup', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


// Logout route (protected by auth middleware)
Route::get('/logout', function () {
    session()->forget('username');
    return redirect('/');
})->name('logout');


