<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\CostumeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

// ✅ Home Route (Ensures 'welcome' route exists)
Route::view('/', 'welcome')->name('welcome');

// ✅ Test Database Connection
Route::get('/test-db', function () {
    try {
        DB::connection()->getPdo();
        return "Database connection is working!";
    } catch (\Exception $e) {
        return "Could not connect to the database. Error: " . $e->getMessage();
    }
});

// ✅ Public Pages
Route::view('/homepage', 'homepage')->name('homepage');
Route::view('/login', 'login')->name('login');
Route::view('/signup', 'signup')->name('signup');
Route::view('/account', 'account')->name('account'); 
Route::view('/cart', 'cart')->name('cart');
Route::view('/categoriespage', 'categoriespage')->name('categoriespage');
Route::view('/booking-form', 'bookingform')->name('bookingform');
Route::view('/about', 'about')->name('about');
Route::get('/info', function () {
    return view('info');
})->name('info');



// ✅ Product & Categories
Route::get('/categories', [CostumeController::class, 'index'])->name('categories');
Route::get('/product/{id}', function ($id) {
    return "Product details for product ID: " . $id;
})->name('product.show');

// ✅ Authentication Routes
Route::post('/signup', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', function () {
    session()->forget('username');
    return redirect('/');
})->name('logout');

// ✅ Reviews
Route::get('/', [ReviewController::class, 'index'])->name('welcome'); // ✅ Load welcome.blade.php with reviews
Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store'); // ✅ Store reviews
// ✅ Admin Routes
Route::view('/admin-dashboard', 'admindashboard')->name('admin.dashboard');
Route::view('/admin-products', 'adminproducts')->name('admin.products');
Route::view('/admin-chat', 'adminchat')->name('admin.chat');

