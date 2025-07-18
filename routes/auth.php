<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DataBerkasController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\JenisLayananController;
use App\Http\Controllers\KategoriLayananController;
use App\Http\Controllers\KategoriPihakController;
use App\Http\Controllers\NotarisController;
use App\Http\Controllers\NotarisDetailController;
use App\Http\Controllers\StafDetailController;
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

    Route::get('/admin/layanan/kategori_pihak', [KategoriPihakController::class, 'index'])->name('admin.layanan.pihak.index');
    Route::post('/admin/layanan/kategori_pihak/store', [KategoriPihakController::class, 'store'])->name('admin.layanan.pihak.store');
    Route::post('/admin/layanan/kategori_pihak/update', [KategoriPihakController::class, 'update'])->name('admin.layanan.pihak.update');
    Route::post('/admin/layanan/kategori_pihak/delete', [KategoriPihakController::class, 'delete'])->name('admin.layanan.pihak.delete');

    Route::get('/admin/berkas', [DataBerkasController::class, 'index'])->name('admin.berkas.index');
    Route::post('/admin/berkas/store', [DataBerkasController::class, 'store'])->name('admin.berkas.store');
    Route::post('/admin/berkas/update', [DataBerkasController::class, 'update'])->name('admin.berkas.update');
    Route::post('/admin/berkas/delete', [DataBerkasController::class, 'delete'])->name('admin.berkas.delete');

    Route::get('/admin/users/staf', [StafDetailController::class, 'index'])->name('admin.users.staf.index');
    Route::post('/admin/users/staf/store', [StafDetailController::class, 'store'])->name('admin.users.staf.store');
    Route::post('/admin/users/staf/update', [StafDetailController::class, 'update'])->name('admin.users.staf.update');
    Route::post('/admin/users/staf/delete', [StafDetailController::class, 'delete'])->name('admin.users.staf.delete');

    Route::get('/admin/users/notaris', [NotarisDetailController::class, 'index'])->name('admin.users.notaris.index');
    Route::post('/admin/users/notaris/store', [NotarisDetailController::class, 'store'])->name('admin.users.notaris.store');
    Route::post('/admin/users/notaris/update', [NotarisDetailController::class, 'update'])->name('admin.users.notaris.update');
    Route::post('/admin/users/notaris/delete', [NotarisDetailController::class, 'delete'])->name('admin.users.notaris.delete');
});

Route::middleware(['auth', 'roleName:notaris'])->group(function () {
    Route::get('notaris/dashboard', [NotarisController::class, 'dashboard'])->name('notaris.dashboard');

    Route::get('notaris/layanan/jadwal', [JadwalController::class, 'index'])->name('notaris.layanan.jadwal.index');
    Route::post('notaris/layanan/jadwal/store', [JadwalController::class, 'store'])->name('notaris.layanan.jadwal.store');
    Route::post('notaris/layanan/jadwal/update', [JadwalController::class, 'update'])->name('notaris.layanan.jadwal.update');
    Route::post('notaris/layanan/jadwal/delete', [JadwalController::class, 'delete'])->name('notaris.layanan.jadwal.delete');
});
