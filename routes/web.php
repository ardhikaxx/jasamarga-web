<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SettingsController;

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

    Route::get('/check-location', function () {
        return view('location.check');
    })->name('check-location');

    Route::get('/input-location', function () {
        return view('location.input');
    })->name('input-location');

    Route::get('/location-sfo', function () {
        return view('location.detail');
    })->name('location-sfo');

    Route::get('/daftar-sfo', function () {
        return view('download.index');
    })->name('daftar-sfo');

    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    Route::post('/settings', [SettingsController::class, 'update'])->name('settings.update');
});