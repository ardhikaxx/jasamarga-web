<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\LocationController;

Route::get('/', function () {
    return view('index');
})->name('home');

// Auth Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected Routes
Route::middleware(['auth:admin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard.index');
    })->name('dashboard');

    // Update route check-location ke controller
    Route::get('/check-location', [LocationController::class, 'showCheckForm'])->name('check-location');
    Route::post('/check-location', [LocationController::class, 'checkLocation'])->name('check-location.process');

    // Update route input-location ke controller
    Route::get('/input-location', [LocationController::class, 'showInputForm'])->name('input-location');
    Route::post('/input-location', [LocationController::class, 'store'])->name('input-location.store');

    // Route untuk detail SFO
    Route::get('/location-sfo/{id}', [LocationController::class, 'showSfoDetails'])->name('location-sfo');

    Route::get('/daftar-sfo', function () {
        return view('download.index');
    })->name('daftar-sfo');

    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    Route::post('/settings', [SettingsController::class, 'update'])->name('settings.update');
});