<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardPembimbingController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index']);

Route::get('/login-admin', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/login-admin', [AdminAuthController::class, 'login']);

// logout
Route::post('/logoutadmin', [AdminAuthController::class, 'logout'])->name('admin.logout');

Route::middleware(AdminMiddleware::class)->group(function () {
    Route::get('/dashboard-admin', [DashboardAdminController::class, 'index'])->name('admin.dashboard');

    Route::get('/dashboard-pembimbing', [DashboardPembimbingController::class, 'index'])->name('pembimbing.dashboard');

    Route::put('/admin/update-kuota', [DashboardAdminController::class, 'updateKuota'])->name('admin.update.kuota');
});
