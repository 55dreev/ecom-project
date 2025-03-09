<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CostumeController;


Route::get('/categories', [CostumeController::class, 'index'])->name('categories');

Route::get('/test-db', function () {
    try {
        DB::connection()->getPdo();
        return "Database connection is working!";
    } catch (\Exception $e) {
        return "Could not connect to the database. Error: " . $e->getMessage();
    }
});//see if database is working

// Homepage route (first page users see, before login)
Route::view('/', 'welcome')->name('welcome');  // Public homepage


Route::view('/homepage', 'homepage')->name('homepage');
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

Route::view('/admin-dashboard', 'admindashboard')->name('admin.dashboard');
Route::view('/admin-products', 'adminproducts')->name('admin.products');

Route::get('/', function () {
    return view('welcome');
});

Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
Route::get('/product', [ReviewController::class, 'index'])->name('product');