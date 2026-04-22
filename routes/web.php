<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\PesertaAuthController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\PesertaDashboardController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardPembimbingController;
use App\Http\Controllers\DashboardPesertaController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\PesertaMiddleware;
use App\Http\Middleware\CalonPesertaMiddleware;
use Illuminate\Support\Facades\Route;


Route::get('/', [DashboardController::class, 'index']);

// login admin
Route::get('/login-admin', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/login-admin', [AdminAuthController::class, 'login']);

// login peserta
Route::get('/login-peserta', [PesertaAuthController::class, 'showLogin'])->name('peserta.login');
Route::post('/login-peserta', [PesertaAuthController::class, 'login']);

// logout
Route::post('/logoutadmin', [AdminAuthController::class, 'logout'])->name('admin.logout');
Route::post('/logout-peserta', [PesertaAuthController::class, 'logout'])->name('peserta.logout');

// register
Route::get('/register-peserta', [PesertaAuthController::class, 'showRegister'])->name('peserta.register');
Route::post('/register-peserta', [PesertaAuthController::class, 'register'])->name('peserta.register');

Route::middleware(AdminMiddleware::class)->group(function () {
    Route::get('/dashboard-admin', [DashboardAdminController::class, 'index'])->name('admin.dashboard');

    Route::get('/dashboard-pembimbing', [DashboardPembimbingController::class, 'index'])->name('pembimbing.dashboard');

    Route::put('/admin/update-kuota', [DashboardAdminController::class, 'updateKuota'])->name('admin.update.kuota');

    // calon peserta
    Route::get('/admin/calon', [DashboardAdminController::class, 'calonPeserta'])->name('admin.calon');

    // detail
    Route::get('/admin/detail/{id}', [DashboardAdminController::class, 'detailPeserta'])->name('admin.detail');
    Route::get('/admin/detail-peserta/{id}', [DashboardAdminController::class, 'detailPesertaAktif'])->name('admin.detail.peserta');
    Route::get('/admin/detail-riwayat/{id}', [DashboardAdminController::class, 'detailPesertaSelesai'])->name('admin.detail.riwayat');

    // aksi
    Route::post('/admin/terima/{id}', [DashboardAdminController::class, 'terima'])->name('admin.terima');
    Route::post('/admin/tolak/{id}', [DashboardAdminController::class, 'tolak'])->name('admin.tolak');
    Route::post('/admin/selesai/{id}', [DashboardAdminController::class, 'selesai'])->name('admin.selesai');
    Route::post('/admin/assign-pembimbing/{id}', [DashboardAdminController::class, 'assignPembimbing'])->name('admin.assign.pembimbing');
    Route::post('/admin/upload-balasan/{id}',
    [DashboardAdminController::class, 'uploadBalasan'])->name('admin.upload.balasan');

    // peserta aktif
    Route::get('/admin/peserta', [DashboardAdminController::class, 'pesertaMagang'])->name('admin.peserta');

    // riwayat
    Route::get('/admin/riwayat', [DashboardAdminController::class, 'riwayat'])->name('admin.riwayat');

});

// ✅ dashboard PESERTA (diterima)
Route::middleware(PesertaMiddleware::class)->group(function () {
    Route::get('/dashboard-peserta', [DashboardPesertaController::class, 'peserta']);
});

// ✅ dashboard CALON
Route::middleware(CalonPesertaMiddleware::class)->group(function () {
    Route::get('/dashboard-calon', [DashboardPesertaController::class, 'calon']);
});

