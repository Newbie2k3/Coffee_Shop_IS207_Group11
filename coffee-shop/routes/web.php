<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminPagesController;
use App\Http\Controllers\GuestPagesController;
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

Route::get('/', [GuestPagesController::class, 'index'])->name('home');
Route::get('/great-deals', [GuestPagesController::class, 'greatDeals'])->name('great-deals');
Route::get('/menu', [GuestPagesController::class, 'menu'])->name('menu');
Route::get('/about', [GuestPagesController::class, 'about'])->name('about');
Route::get('/cart', [GuestPagesController::class, 'cart'])->name('cart');

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'verified', 'isAdmin']], function () {
    Route::view('/', 'pages.admin.dashboard')->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
