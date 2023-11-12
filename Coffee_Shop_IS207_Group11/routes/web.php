<?php

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

Route::get('/', function () {
    return view('pages.home.index');
})->name('home');

Route::get('/great-deals', function () {
    return view('pages.great-deals.index');
})->name('great-deals');

Route::get('/menu', function () {
    return view('pages.menu.index');
})->name('menu');

Route::get('/about', function () {
    return view('pages.about.index');
})->name('about');

Route::get('/account', function () {
    return view('pages.account.index');
})->name('account');

Route::get('/cart', function () {
    return view('pages.cart.index');
})->name('cart');
