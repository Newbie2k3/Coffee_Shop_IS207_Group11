<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GuestPagesController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
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
Route::get('/', [GuestPagesController::class, 'index'])->name('home');
Route::get('/great-deals', [GuestPagesController::class, 'greatDeals'])->name('great-deals');
Route::get('/menu', [GuestPagesController::class, 'menu'])->name('menu');
Route::get('/about', [GuestPagesController::class, 'about'])->name('about');
Route::get('/cart', [GuestPagesController::class, 'cart'])->name('cart');
Route::get('/product_detail/{id}',[ProductController::class,'product_detail'])->name('product_detail');

//admin
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'verified', 'isAdmin']], function () {
    Route::view('/', 'dashboard')->name('dashboard');

    //Khach hang
    Route::get('/user',[UserController::class, 'show'])->name('user');

    //Danh muc san pham
    Route::get('/category',[CategoryController::class,'show'])->name('category');
    Route::get('category/create',[CategoryController::class, 'create'])->name('category_create');
    Route::post('category',[CategoryController::class, 'store'])->name('category_store');
    Route::get('/category/{id}/edit',[CategoryController::class,'edit'])->name('category_edit');
    Route::put('/category/{id}',[CategoryController::class,'update'])->name('category_update');
    Route::delete('/category/{id}',[CategoryController::class,'destroy'])->name('category_destroy');

    //San pham
    Route::get('/product',[ProductController::class,'show'])->name('product');
    Route::get('product/create',[ProductController::class, 'create'])->name('product_create');
    Route::post('product',[ProductController::class, 'store'])->name('product_store');
    Route::get('/product/{id}/edit',[ProductController::class,'edit'])->name('product_edit');
    Route::put('/product/{id}',[ProductController::class,'update'])->name('product_update');
    Route::delete('/product/{id}',[ProductController::class,'destroy'])->name('product_destroy');

});

//chinh sửa thông tin
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
