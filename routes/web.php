<?php

use App\Http\Controllers\AspirasiController;
use App\Http\Controllers\Auth\AdminForgotPasswordController;
use App\Http\Controllers\Auth\AdminGoogleAuthController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\AdminResetPasswordController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// ============================================================
// PUBLIC ROUTES
// ============================================================

Route::get('/', function () {
    return redirect()->route('admin.login');
});

Route::get('/admin/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminLoginController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');
Route::get('/admin/auth/google', [AdminGoogleAuthController::class, 'redirect'])->name('admin.auth.google');
Route::get('/admin/auth/google/callback', [AdminGoogleAuthController::class, 'callback'])
    ->name('admin.auth.google.callback');
Route::get('/admin/forgot-password', [AdminForgotPasswordController::class, 'showLinkRequestForm'])
    ->name('admin.password.request');
Route::post('/admin/forgot-password', [AdminForgotPasswordController::class, 'sendResetLinkEmail'])
    ->name('admin.password.email');
Route::get('/admin/reset-password/{token}', [AdminResetPasswordController::class, 'showResetForm'])
    ->name('admin.password.reset');
Route::post('/admin/reset-password', [AdminResetPasswordController::class, 'reset'])
    ->name('admin.password.update');

// ============================================================
// PROTECTED ROUTES (Admin Only)
// ============================================================

Route::middleware(['auth:admin'])->group(function () {

    // Dashboard Utama
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Management Aspirasi (Inbound dari Flutter)
    Route::get('/admin/aspirasi', [AspirasiController::class, 'index'])->name('admin.aspirasi.index');
    Route::post('/admin/update-status', [DashboardController::class, 'updateStatus'])->name('admin.update-status');

    // FIX ERROR: Rute ini dipanggil di Sidebar Layout, jadi wajib ada!
    // Kita arahkan sementara ke DashboardController agar aplikasi tidak crash
    Route::get('/admin/siswa', [DashboardController::class, 'index'])->name('admin.siswa.index');
    Route::get('/admin/kategori', [DashboardController::class, 'index'])->name('admin.kategori.index');

});
