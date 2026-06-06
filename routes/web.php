<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\ReportController;

Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('material', MaterialController::class);
    Route::get('/monitoring', [MaterialController::class, 'monitoring'])->name('monitoring');
    Route::get('/prioritas', [MaterialController::class, 'prioritas'])->name('prioritas');

    Route::resource('barang-masuk', BarangMasukController::class);
    Route::resource('barang-keluar', BarangKeluarController::class);

    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/material', [ReportController::class, 'material'])->name('reports.material');
    Route::get('/reports/barang-masuk', [ReportController::class, 'barangMasuk'])->name('reports.barang-masuk');
    Route::get('/reports/barang-keluar', [ReportController::class, 'barangKeluar'])->name('reports.barang-keluar');
    Route::get('/reports/prioritas', [ReportController::class, 'prioritas'])->name('reports.prioritas');
});
