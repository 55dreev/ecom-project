<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\CostumeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductController;

// routes for cart adding, removing, etc..
Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');
Route::post('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
// ✅ Home Route (Ensures 'welcome' route exists)

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

//route to get costumes to show
Route::get('/costume/{id}', [CostumeController::class, 'show'])->name('costume.show');
Route::post('/products/store', [CostumeController::class, 'store'])->name('products.store');
Route::delete('/products/delete-by-image', [ProductController::class, 'deleteByImage'])->name('products.deleteByImage');

// ✅ Public Pages
Route::view('/homepage', 'homepage')->name('homepage');
Route::view('/welcome', 'welcome')->name('welcome');
Route::view('/login', 'login')->name('login');
Route::view('/signup', 'signup')->name('signup');
Route::view('/categoriespage', 'categoriespage')->name('categoriespage');
Route::get('/booking-form', [CheckoutController::class, 'showCheckout'])->name('bookingform');
Route::view('/about', 'about')->name('about');
Route::get('/info', function () {
    return view('info');
})->name('info');

Route::post('/submit-checkout', [CheckoutController::class, 'submitCheckout'])->name('submit.checkout');


Route::middleware(['web'])->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'showCheckout'])->name('checkout');
});



// ✅ Product & Categories

Route::get('/categoriespage', [CostumeController::class, 'index'])->name('categoriespage');
Route::get('/product/{id}', function ($id) {
    return "Product details for product ID: " . $id;
})->name('product.show');



// ✅ Authentication Routes
Route::post('/signup', [AuthController::class, 'register'])->name('signup');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/account', [AccountController::class, 'index'])->name('account')->middleware('auth');

// ✅ Reviews
//Route::get('/', [ReviewController::class, 'index'])->name('welcome'); // ✅ Load welcome.blade.php with reviews
Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store'); // ✅ Store reviews
// ✅ Admin Routes
Route::delete('/admin/products/delete/{id}', [ProductController::class, 'deleteById'])
    ->name('admin.products.delete');
Route::view('/admin-dashboard', 'admindashboard')->name('admin.dashboard');
Route::view('/admin-products', 'adminproducts')->name('admin.products');
Route::view('/admin-chat', 'adminchat')->name('admin.chat');
Route::resource('costume', CostumeController::class);
