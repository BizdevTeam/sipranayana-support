<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SystemController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AccountTypeController;

Route::redirect('/', '/login');
Route::get('/login',[AuthController::class,'index']);
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::prefix('admin/AccountType')->group(function(){
        Route::get('/',[AccountTypeController::class,'index'])->name('admin.accountType');
        Route::post('/create',[AccountTypeController::class,'store'])->name('admin.add.accountType');
        Route::put('/{id}',[AccountTypeController::class,'update'])->name('admin.edit.accountType');
        Route::delete('/{id}',[AccountTypeController::class,'destroy'])->name('admin.delete.accountType');
    });
    // Manajemen Pengguna
    Route::prefix('admin/users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('admin.users');
        Route::post('/create', [UserController::class, 'store'])->name('admin.add.users');
        Route::put('/{id}', [UserController::class, 'update'])->name('admin.edit.users');
        Route::delete('/{id}', [UserController::class, 'destroy'])->name('admin.delete.users');
    });

    // Manajemen Sistem
    Route::prefix('admin/system')->group(function () {
        Route::get('/', [SystemController::class, 'index'])->name('admin.sistem');
        Route::post('/create', [SystemController::class, 'store'])->name('admin.add.sistem');
        Route::put('/{id}', [SystemController::class, 'update'])->name('admin.edit.sistem');
        Route::delete('/{id}', [SystemController::class, 'destroy'])->name('admin.delete.sistem');
    });

    // Manajemen Topik
    Route::prefix('admin/topics')->group(function () {
        Route::get('/', [TopicController::class, 'index'])->name('admin.topic');
        Route::post('/create', [TopicController::class, 'store'])->name('admin.add.topic');
        Route::put('/{id}', [TopicController::class, 'update'])->name('admin.edit.topic');
        Route::delete('/{id}', [TopicController::class, 'destroy'])->name('admin.delete.topic');
    });

    // Manajemen Laporan
    Route::prefix('admin/report')->group(function () {
        Route::get('/', [ReportController::class, 'index'])->name('admin.report');
        Route::put('/{id}', [ReportController::class, 'proses'])->name('admin.proses.reports');
        Route::put('/{id}/selesai', [ReportController::class, 'selesai'])->name('admin.selesai.reports');
        Route::delete('/{id}', [ReportController::class, 'destroy'])->name('admin.delete.reports');
    });
});

// Middleware untuk user
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'user'])->name('user.dashboard');

    Route::prefix('/report')->group(function () {
        Route::get('/', [ReportController::class, 'user'])->name('user.report');
        Route::post('/create', [ReportController::class, 'store'])->name('user.add.report');
        Route::put('/{id}', [ReportController::class, 'update'])->name('user.update.report');
        Route::delete('/{id}', [ReportController::class, 'destroy'])->name('user.delete.report');
    });
});