<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DataBerkasController;
use App\Http\Controllers\JenisLayananController;
use App\Http\Controllers\KategoriLayananController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    // login routes
    Route::get('/', [AuthController::class, 'index'])->name('login');

    Route::post('/', [AuthController::class, 'login'])->name('user.login');

});

Route::middleware('auth')->group(function () {
    // login routes
    Route::get('/logout', [AuthController::class, 'logout'])->name('user.logout');

});

Route::middleware(['auth', 'roleName:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    Route::get('/admin/layanan/kategori', [KategoriLayananController::class, 'index'])->name('admin.layanan.kategori.index');
    Route::post('/admin/layanan/kategori/store', [KategoriLayananController::class, 'store'])->name('admin.layanan.kategori.store');
    Route::post('/admin/layanan/kategori/update', [KategoriLayananController::class, 'update'])->name('admin.layanan.kategori.update');
    Route::post('/admin/layanan/kategori/delete', [KategoriLayananController::class, 'delete'])->name('admin.layanan.kategori.delete');

    Route::get('/admin/layanan/jenis', [JenisLayananController::class, 'index'])->name('admin.layanan.jenis.index');
    Route::post('/admin/layanan/jenis/store', [JenisLayananController::class, 'store'])->name('admin.layanan.jenis.store');
    Route::post('/admin/layanan/jenis/update', [JenisLayananController::class, 'update'])->name('admin.layanan.jenis.update');
    Route::post('/admin/layanan/jenis/delete', [JenisLayananController::class, 'delete'])->name('admin.layanan.jenis.delete');

    Route::get('/admin/berkas', [DataBerkasController::class, 'index'])->name('admin.berkas.index');
    Route::post('/admin/berkas/store', [DataBerkasController::class, 'store'])->name('admin.berkas.store');
    Route::post('/admin/berkas/update', [DataBerkasController::class, 'update'])->name('admin.berkas.update');
    Route::post('/admin/berkas/delete', [DataBerkasController::class, 'delete'])->name('admin.berkas.delete');
});
