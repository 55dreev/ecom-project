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

Route::view('/account', 'account')->name('account'); // My account view
Route::view('/cart', 'cart')->name('cart'); // Cart view
Route::view('/categoriespage', 'categoriespage')->name('categoriespage');
Route::view('/booking-form', 'bookingform')->name('bookingform');

// Logout route (protected by auth middleware)
Route::get('/logout', function () {
    session()->forget('username');
    return redirect('/');
})->name('logout');

// Product route
Route::get('/product/{id}', function ($id) {
    return "Product details for product ID: " . $id;
})->name('product.show');



