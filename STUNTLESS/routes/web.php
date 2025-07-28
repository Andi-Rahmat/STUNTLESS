<?php

use App\Http\Controllers\LoginController;
use App\Http\Middleware\CheckUserRole;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('backend.pages.welcome');
});

Route::middleware('role:admin')->group(function () {
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/dashboard', function () {
        return view('backend.pages.dashboard');
    });

    Route::get('/data-pendaftar', function () {
        return view('backend.pages.data-pendaftar');
    });
});

Route::get('/pendaftaran', function () {
    return view('backend.pages.pendaftaran');
});

Route::post('/pendaftaran', [LoginController::class, 'login'])->name('pendaftaran');

Route::get('/login', function () {
    return view('backend.pages.login');
})->name('login.index');

Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
