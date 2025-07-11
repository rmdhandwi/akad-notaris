<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    // login routes
    Route::get('/', [AuthController::class, 'index'])->name('user.login.index');

});

Route::middleware('auth')->group(function () {

});
