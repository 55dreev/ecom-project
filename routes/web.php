<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\CostumeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

// ✅ Home Route
Route::view('/', 'homepage')->name('homepage');

// ✅ Test Database Connection
Route::get('/test-db', function () {
    try {
        DB::connection()->getPdo();
        return "Database connection is working!";
    } catch (\Exception $e) {
        return "Could not connect to the database. Error: " . $e->getMessage();
    }
});

// ✅ Cart Routes
Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');
Route::post('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');

// ✅ Product & Categories Routes
Route::get('/categories', [CostumeController::class, 'index'])->name('categories');
Route::get('/costume/{id}', [CostumeController::class, 'show'])->name('costume.show');
Route::post('/products/store', [CostumeController::class, 'store'])->name('products.store');
Route::delete('/products/delete-by-image', [ProductController::class, 'deleteByImage'])->name('products.deleteByImage');

// ✅ Authentication Routes
Route::post('/signup', [AuthController::class, 'register'])->name('signup');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/account', [AccountController::class, 'index'])->name('account')->middleware('auth');

// ✅ Checkout Routes
Route::middleware(['web'])->group(function () {
    Route::get('/bookingform', [CheckoutController::class, 'showCheckout'])->name('bookingform');
    Route::post('/submit-bookingform', [CheckoutController::class, 'submitCheckout'])->name('submit.bookingform');
});


// ✅ Public Pages
Route::view('/homepage', 'homepage')->name('homepage');
Route::view('/welcome', 'welcome')->name('welcome');
Route::view('/login', 'login')->name('login');
Route::view('/signup', 'signup')->name('signup');
Route::view('/categoriespage', 'categoriespage')->name('categoriespage');
Route::view('/about', 'about')->name('about');
Route::view('/info', 'info')->name('info');
Route::get('/product/{id}', [CostumeController::class, 'show'])->name('product.show');


// ✅ Reviews
Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');

// ✅ Admin Routes
Route::delete('/admin/products/delete/{id}', [ProductController::class, 'deleteById'])->name('admin.products.delete');
Route::view('/admin-dashboard', 'admindashboard')->name('admin.dashboard');
Route::view('/admin-products', 'adminproducts')->name('admin.products');
Route::view('/admin-chat', 'adminchat')->name('admin.chat');

// ✅ Resource Routes
Route::resource('costume', CostumeController::class);