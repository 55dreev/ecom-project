<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\CostumeController;
<<<<<<< Updated upstream
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductController;
=======
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\AdminChatController;
use Illuminate\Support\Facades\Auth;
>>>>>>> Stashed changes

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

<<<<<<< Updated upstream
//route to get costumes to show
=======
// Order admin
// Order management routes
    Route::get('/admin/orders', [AdminOrderController::class, 'index'])->name('admin.orders.index');
    Route::get('/admin/orders/{order}/edit', [AdminOrderController::class, 'edit'])->name('admin.orders.edit');
    Route::put('/admin/orders/{order}', [AdminOrderController::class, 'update'])->name('admin.orders.update');
    Route::delete('/admin/orders/{order}', [AdminOrderController::class, 'destroy'])->name('admin.orders.destroy');



// ✅ Cart Routes
Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');
Route::post('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');

// ✅ Product & Categories Routes
Route::get('/categories', [CostumeController::class, 'index'])->name('categories');
>>>>>>> Stashed changes
Route::get('/costume/{id}', [CostumeController::class, 'show'])->name('costume.show');
Route::post('/products/store', [CostumeController::class, 'store'])->name('products.store');
Route::delete('/products/delete-by-image', [ProductController::class, 'deleteByImage'])->name('products.deleteByImage');

// ✅ Public Pages
Route::view('/homepage', 'homepage')->name('homepage');
Route::view('/welcome', 'welcome')->name('welcome');
Route::view('/login', 'login')->name('login');
Route::view('/signup', 'signup')->name('signup');
Route::view('/account', 'account')->name('account'); 
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
Route::post('/signup', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', function () {
    session()->forget('username');
    return redirect('/');
})->name('logout');

// ✅ Reviews
//Route::get('/', [ReviewController::class, 'index'])->name('welcome'); // ✅ Load welcome.blade.php with reviews
Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store'); // ✅ Store reviews
// ✅ Admin Routes
Route::delete('/admin/products/delete/{id}', [ProductController::class, 'deleteById'])
    ->name('admin.products.delete');
Route::view('/admin-dashboard', 'admindashboard')->name('admin.dashboard');
<<<<<<< Updated upstream
Route::view('/admin-products', 'adminproducts')->name('admin.products');
Route::view('/admin-chat', 'adminchat')->name('admin.chat');
=======
Route::get('/admin-products', [ProductController::class, 'index'])->name('admin.products');
Route::delete('/admin/orders/delete/{orderId}', [ProductController::class, 'deleteOrder'])->name('orders.destroy');
Route::put('/admin/orders/update/{orderId}', [ProductController::class, 'updateOrder'])->name('orders.update');

//Admin chat
Route::middleware('auth')->group(function () {
    Route::get('/admin/chat', [AdminChatController::class, 'index'])->name('admin.chat');
    Route::get('/admin/chat/user/{id}', [AdminChatController::class, 'fetchUserMessages'])->name('admin.chat.user');
    Route::post('/admin/chat/user/{id}', [AdminChatController::class, 'sendMessage'])->name('admin.chat.send');
});

// ✅ Resource Routes
>>>>>>> Stashed changes
Route::resource('costume', CostumeController::class);

//chat
Route::middleware(['auth'])->group(function () {
    Route::post('/send-chat', [ChatController::class, 'send'])->name('chat.send');
    Route::get('/fetch-messages', [ChatController::class, 'fetch'])->name('chat.fetch'); // ✅ This is what was missing
});

Route::get('/check-auth', function () {
    return auth()->check() ? '✅ Authenticated as ID: ' . auth()->id() : '❌ Not logged in';
});
Broadcast::routes(['middleware' => ['auth']]);
