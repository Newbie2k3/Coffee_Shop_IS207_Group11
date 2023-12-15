<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GuestPageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//guest
Route::get('/', [GuestPageController::class, 'index'])->name('home');
Route::get('/great-deals', [GuestPageController::class, 'greatDeals'])->name('great-deals');
Route::get('/menu', [GuestPageController::class, 'menu'])->name('menu');
Route::get('/about', [GuestPageController::class, 'about'])->name('about');
Route::get('/product_detail/{id}', [ProductController::class, 'product_detail'])->name('product_detail');

//admin
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'verified', 'isAdmin']], function () {
    Route::get('/', [OrderController::class, 'statistic'])->name('dashboard');
    Route::get('/chartStatistic', [OrderController::class, 'chartStatistic'])->name('statisticChart');
    //Khach hang
    Route::get('/user', [UserController::class, 'show'])->name('user');
    Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user_edit');
    Route::put('/user/{id}', [UserController::class, 'update'])->name('user_update');
    Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user_destroy');

    //Danh muc san pham
    Route::get('/category', [CategoryController::class, 'show'])->name('category');
    Route::get('category/create', [CategoryController::class, 'create'])->name('category_create');
    Route::post('category', [CategoryController::class, 'store'])->name('category_store');
    Route::get('/category/{id}/edit', [CategoryController::class, 'edit'])->name('category_edit');
    Route::put('/category/{id}', [CategoryController::class, 'update'])->name('category_update');
    Route::delete('/category/{id}', [CategoryController::class, 'destroy'])->name('category_destroy');

    //San pham
    Route::get('/product', [ProductController::class, 'show'])->name('product');
    Route::get('/get-products/{category_id}', 'ProductController@getProducts')->name('get-products');
    Route::get('/search', [ProductController::class, 'search'])->name('product_search');
    Route::get('product/create', [ProductController::class, 'create'])->name('product_create');
    Route::post('product', [ProductController::class, 'store'])->name('product_store');
    Route::get('/product/{id}/edit', [ProductController::class, 'edit'])->name('product_edit');
    Route::put('/product/{id}', [ProductController::class, 'update'])->name('product_update');
    Route::delete('/product/{id}', [ProductController::class, 'destroy'])->name('product_destroy');
});

//Login Required
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    // Shopping cart
    Route::get('/cart', [CartController::class, 'view'])->name('cart');
    Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('cart.store');
    Route::delete('/remove-from-cart', [CartController::class, 'removeItem'])->name('cart.remove');
    Route::put('/update-cart-qty', [CartController::class, 'updateQuantity'])->name('cart.update');
    Route::get('/get-cart-count', [CartController::class, 'getCartCount'])->name('cart.count');
    Route::get('/get-cart', [CartController::class, 'getCart'])->name('cart.getcart');
});
Route::middleware('auth')->group(function () {
    Route::get('/order', [OrderController::class, 'view'])->name('order.index');
    Route::post('/create-order', [OrderController::class, 'insertOrder'])->name('order.create');
    Route::post('/payment-vnpay', [OrderController::class, 'paymentVnpay'])->name('payment-vnpay');
    Route::get('/payment-vnpay-return', [OrderController::class, 'paymentResult'])->name('payment-vnpay-return');
});
require __DIR__ . '/auth.php';
