<?php

use App\Http\Controllers\ibuController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('backend.pages.welcome');
});

// Hrus login
Route::middleware('auth')->group(function () {
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::middleware('role:admin')->group(function () {
    
        Route::get('admin/dashboard', function () {
            return view('backend.admin.dashboard');
        })->name('admin.dashboard');

        Route::get('admin/daftar-ibu', [ibuController::class, 'index'])->name('daftar_ibu');
    
        Route::get('/data-pendaftar', function () {
            return view('backend.pages.data-pendaftar');
        });
    });
    Route::middleware('role:user')->group(function () {

        Route::get('ibu/dashboard', function () {
            return view('backend.ibu.dashboard');
        });
    });
});


Route::get('/login', function () {
    if (Auth::check()) {
        return redirect()->to('admin/dashboard');
    }else{
        return view('backend.pages.login');
    }
})->name('login.index');

Route::get('/registrasi', function () {
    return view('backend.pages.registrasi');
})->name('registrasi.index');

Route::post('/registrasi', [LoginController::class, 'registrasi'])->name('registrasi');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
