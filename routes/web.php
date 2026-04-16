<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login-admin', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/login-admin', [AdminAuthController::class, 'login']);

// logout
Route::post('/logoutadmin', [AdminAuthController::class, 'logout'])->name('admin.logout');

Route::middleware(AdminMiddleware::class)->group(function () {
Route::get('/dashboard-admin', [DashboardAdminController::class, 'index'])->name('admin.dashboard');
});
