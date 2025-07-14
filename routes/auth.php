<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\KategoriLayananController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    // login routes
    Route::get('/', [AuthController::class, 'index'])->name('user.login.index');

    Route::post('/', [AuthController::class, 'login'])->name('user.login');

});

Route::middleware('auth')->group(function () {
    // login routes
    Route::get('/logout', [AuthController::class, 'logout'])->name('user.logout');

});

Route::middleware(['auth', 'roleName:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    Route::get('/admin/layanan/kategori', [KategoriLayananController::class, 'index'])->name('admin.layanan.kategori.index');
});
