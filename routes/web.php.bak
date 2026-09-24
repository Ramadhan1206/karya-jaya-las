<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\CatatanHarianController;
use App\Http\Controllers\CatatanGajianController;
use App\Http\Controllers\ProyekController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\UserMiddleware;
use Illuminate\Support\Facades\Route;

// ============================================================
// 1. HALAMAN UTAMA (WELCOME)
// ============================================================
Route::get('/', function () {
    return view('welcome');
})->name('home');

// ============================================================
// 2. PROYEK (PUBLIC - Untuk Semua User)
// ============================================================
Route::get('/proyek', [ProyekController::class, 'index'])->name('proyek.index');
Route::get('/proyek/{slug}', [ProyekController::class, 'show'])->name('proyek.show');

// ============================================================
// 3. GUEST ROUTES (BELUM LOGIN)
// ============================================================
Route::middleware(['guest'])->group(function () {
    // Login
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    
    // Register
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
    
    // Lupa Password
    Route::get('/forgot-password', [AuthController::class, 'showForgotForm'])->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
    Route::get('/reset-password/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
});

// ============================================================
// 4. AUTH ROUTES (SUDAH LOGIN)
// ============================================================
Route::middleware(['auth'])->group(function () {
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Dashboard Redirect
    Route::get('/dashboard', function () {
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('user.dashboard');
    })->name('dashboard');

    // ============================================================
    // 4a. PROFILE ROUTES (UMUM)
    // ============================================================
    Route::get('/profile', [AuthController::class, 'showProfile'])->name('profile');
    Route::put('/profile', [AuthController::class, 'updateProfile'])->name('profile.update');
    Route::get('/profile/change-password', [AuthController::class, 'showChangePassword'])->name('profile.change-password');
    Route::put('/profile/change-password', [AuthController::class, 'changePassword'])->name('profile.update-password');

    // ============================================================
    // 4b. USER ROUTES
    // ============================================================
    Route::middleware([UserMiddleware::class])->prefix('user')->name('user.')->group(function () {
        // Dashboard
        Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
        
        // Profile
        Route::get('/profile', [UserController::class, 'profile'])->name('profile');
        Route::put('/profile', [UserController::class, 'updateProfile'])->name('profile.update');
        
        // Change Password
        Route::get('/change-password', [UserController::class, 'changePassword'])->name('change-password');
        Route::put('/change-password', [UserController::class, 'updatePassword'])->name('update-password');
        
        // Edit Nama
        Route::get('/edit-nama', [UserController::class, 'editNama'])->name('edit-nama');
        Route::put('/edit-nama', [UserController::class, 'updateNama'])->name('update-nama');
        
        // Karyawan
        Route::get('/karyawan', [UserController::class, 'karyawan'])->name('karyawan');
        
        // Catatan Harian
        Route::get('/catatan-harian', [CatatanHarianController::class, 'index'])->name('catatan-harian');
        Route::post('/catatan-harian', [CatatanHarianController::class, 'store'])->name('catatan-harian.store');
        Route::get('/catatan-harian/{id}/edit', [CatatanHarianController::class, 'edit'])->name('catatan-harian.edit');
        Route::put('/catatan-harian/{id}', [CatatanHarianController::class, 'update'])->name('catatan-harian.update');
        Route::delete('/catatan-harian/{id}', [CatatanHarianController::class, 'destroy'])->name('catatan-harian.destroy');
        
        // Gajian
        Route::get('/gajian', [CatatanGajianController::class, 'index'])->name('gajian.index');
        Route::get('/gajian/create', [CatatanGajianController::class, 'create'])->name('gajian.create');
        Route::post('/gajian', [CatatanGajianController::class, 'store'])->name('gajian.store');
        Route::post('/gajian/generate', [CatatanGajianController::class, 'generate'])->name('gajian.generate');
        Route::post('/gajian/generate-semua', [CatatanGajianController::class, 'generateSemua'])->name('gajian.generate-semua');
        Route::get('/gajian/{id}', [CatatanGajianController::class, 'show'])->name('gajian.show');
        Route::get('/gajian/{id}/edit', [CatatanGajianController::class, 'edit'])->name('gajian.edit');
        Route::put('/gajian/{id}', [CatatanGajianController::class, 'update'])->name('gajian.update');
        Route::delete('/gajian/{id}', [CatatanGajianController::class, 'destroy'])->name('gajian.destroy');
        
        // Settings
        Route::get('/settings', [UserController::class, 'settings'])->name('settings');
        Route::get('/aktivitas', [UserController::class, 'aktivitas'])->name('aktivitas');
    });

    // ============================================================
    // 4c. ADMIN ROUTES
    // ============================================================
    Route::middleware([AdminMiddleware::class])->prefix('admin')->name('admin.')->group(function () {
        // Dashboard
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        
        // Edit Nama Admin
        Route::get('/edit-nama', [AdminController::class, 'editNama'])->name('edit-nama');
        Route::put('/edit-nama', [AdminController::class, 'updateNama'])->name('update-nama');
        
        // User Management
        Route::get('/users', [AdminController::class, 'users'])->name('users');
        Route::get('/users/{id}/edit', [AdminController::class, 'editUser'])->name('users.edit');
        Route::put('/users/{id}', [AdminController::class, 'updateUser'])->name('users.update');
        Route::delete('/users/{id}', [AdminController::class, 'deleteUser'])->name('users.delete');
        
        // Karyawan Management
        Route::get('/karyawan', [AdminController::class, 'karyawanIndex'])->name('karyawan.index');
        Route::get('/karyawan/create', [AdminController::class, 'karyawanCreate'])->name('karyawan.create');
        Route::post('/karyawan', [AdminController::class, 'karyawanStore'])->name('karyawan.store');
        Route::get('/karyawan/{id}/edit', [AdminController::class, 'karyawanEdit'])->name('karyawan.edit');
        Route::put('/karyawan/{id}', [AdminController::class, 'karyawanUpdate'])->name('karyawan.update');
        Route::delete('/karyawan/{id}', [AdminController::class, 'karyawanDestroy'])->name('karyawan.destroy');
        
        // Absen Admin
        Route::get('/absen', [AdminController::class, 'absen'])->name('absen');
        Route::get('/absen/{id}', [AdminController::class, 'absenDetail'])->name('absen.detail');
        
        // Catatan Harian Admin
        Route::get('/catatan-harian', [AdminController::class, 'catatanHarian'])->name('catatan-harian');
        Route::get('/catatan-harian/{id}', [AdminController::class, 'catatanHarianDetail'])->name('catatan-harian.detail');
        Route::delete('/catatan-harian/{id}', [AdminController::class, 'catatanHarianDelete'])->name('catatan-harian.delete');
        
        // Gajian Admin
        Route::get('/gajian', [AdminController::class, 'gajianIndex'])->name('gajian');
        Route::get('/gajian/{id}', [AdminController::class, 'gajianDetail'])->name('gajian.detail');
        Route::post('/gajian/{id}/update-status', [AdminController::class, 'gajianUpdateStatus'])->name('gajian.update-status');
        Route::delete('/gajian/{id}', [AdminController::class, 'gajianDelete'])->name('gajian.delete');
        
        // Proyek Admin
        Route::get('/proyek', [ProyekController::class, 'adminIndex'])->name('proyek.index');
        Route::get('/proyek/create', [ProyekController::class, 'create'])->name('proyek.create');
        Route::post('/proyek', [ProyekController::class, 'store'])->name('proyek.store');
        Route::get('/proyek/{id}/edit', [ProyekController::class, 'edit'])->name('proyek.edit');
        Route::put('/proyek/{id}', [ProyekController::class, 'update'])->name('proyek.update');
        Route::delete('/proyek/{id}', [ProyekController::class, 'destroy'])->name('proyek.destroy');
        Route::delete('/foto-proyek/{id}', [ProyekController::class, 'deleteFoto'])->name('foto-proyek.delete');
        Route::post('/foto-proyek/{id}/set-cover', [ProyekController::class, 'setCover'])->name('foto-proyek.set-cover');
        Route::get('/proyek/{id}', [ProyekController::class, 'adminShow'])->name('proyek.show');
        
        // Settings
        Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
    });
});