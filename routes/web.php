<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('/login', function (){
    return view('auth.login');
});

Route::get('/register', function (){
    return view('auth.register');
});

Route::get('/dashboard', function (){
    return view('dashboard.index');
})->name('dashboard');

Route::get('/check-location', function (){
    return view('location.check');
})->name('check-location');

Route::get('/input-location', function (){
    return view('location.input');
})->name('input-location');

Route::get('/location-sfo', function (){
    return view('location.detail');
})->name('location-sfo');

Route::get('/daftar-sfo', function (){
    return view('download.index');
})->name('daftar-sfo');

Route::get('/settings', function (){
    return view('settings.index');
})->name('settings');