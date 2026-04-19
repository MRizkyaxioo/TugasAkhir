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
});

// ✅ dashboard PESERTA (diterima)
Route::middleware(PesertaMiddleware::class)->group(function () {
    Route::get('/dashboard-peserta', [DashboardPesertaController::class, 'peserta']);
});

// ✅ dashboard CALON
Route::middleware(CalonPesertaMiddleware::class)->group(function () {
    Route::get('/dashboard-calon', [DashboardPesertaController::class, 'calon']);
});

