<?php

use App\Http\Controllers\LoginController;
use App\Http\Middleware\CheckUserRole;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('backend.pages.welcome');
});

Route::middleware('role:admin')->group(function () {
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('admin/dashboard', function () {
        return view('backend.pages.dashboard');
    });

    Route::get('/data-pendaftar', function () {
        return view('backend.pages.data-pendaftar');
    });
});

Route::middleware('role:user')->group(function () {
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('admin/dashboard', function () {
        return view('backend.pages.dashboard');
    });

    Route::get('/data-pendaftar', function () {
        return view('backend.pages.data-pendaftar');
    });
});

Route::get('/login', function () {
    return view('backend.pages.login');
})->name('login.index');

Route::get('/registrasi', function () {
    return view('backend.pages.registrasi');
})->name('registrasi.index');

Route::post('/registrasi', [LoginController::class, 'registrasi'])->name('registrasi');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
