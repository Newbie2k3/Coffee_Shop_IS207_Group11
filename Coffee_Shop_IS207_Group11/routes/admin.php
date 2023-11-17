<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminPagesController;

Route::prefix('admin')->group(function () {
    Route::get('/', [AdminPagesController::class, 'index']);
});