<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\AspirasiController;

// ============================================================
// PUBLIC ROUTES
// ============================================================

Route::get('/', function () {
    return redirect()->route('admin.login');
});

Route::get('/admin/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminLoginController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

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