<?php

use Illuminate\Support\Facades\Route;
// Controller
use App\Http\Controllers\PagesController;

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

Route::get('/', [PagesController::class, 'index'])->name('home');
Route::get('/great-deals', [PagesController::class, 'greatDeals'])->name('great-deals');
Route::get('/menu', [PagesController::class, 'menu'])->name('menu');
Route::get('/about', [PagesController::class, 'about'])->name('about');
Route::get('/account', [PagesController::class, 'account'])->name('account');
Route::get('/cart', [PagesController::class, 'cart'])->name('cart');


// Account
Route::get('/login', function () {
    return view('pages.account.login');
})->name('login');

Route::get('/register', function () {
    return view('pages.account.register');
})->name('register');
