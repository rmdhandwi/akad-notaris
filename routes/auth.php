<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    // login routes
    Route::get('/', [AuthController::class, 'index'])->name('user.login.index');

    Route::post('/', [AuthController::class, 'login'])->name('user.login');

});

Route::middleware('auth', 'roleName:admin')->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});
