<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\WorkController;
use App\Http\Controllers\SFOController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CheckLocationController;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/cek-lokasi-sfo', [HomeController::class, 'checkLocation'])->name('home.cekLokasiSfo');

// Auth Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected Routes
Route::middleware(['auth:admin'])->group(function () {
    //dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // API untuk grafik (jika diperlukan)
    Route::get('/dashboard/chart-data', [DashboardController::class, 'getChartData'])->name('dashboard.chart-data');

    Route::resource('projects', ProjectController::class);
    Route::resource('locations', LocationController::class);
    Route::resource('work', WorkController::class);

    // SFO Routes
    Route::resource('sfo', SFOController::class);
    Route::post('sfo/{sfo}/update-status', [SFOController::class, 'updateStatus'])->name('sfo.update-status');
    Route::post('sfo/calculate-luas', [SFOController::class, 'calculateLuas'])->name('sfo.calculate-luas');
    // routes/web.php
Route::get('export-sfo', [SFOController::class, 'exportReport'])->name('export.sfo');

    // Check Location Routes
    Route::get('/check-location', [CheckLocationController::class, 'index'])->name('check-location');
    Route::post('/check-location', [CheckLocationController::class, 'check'])->name('check-location.process');
    Route::get('/check-location/detail/{id}', [CheckLocationController::class, 'detail'])->name('check-location.detail');
    Route::get('/check-location/sta-data', [CheckLocationController::class, 'getStaData'])->name('check-location.sta-data');

    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    Route::post('/settings', [SettingsController::class, 'update'])->name('settings.update');
});