<?php

use App\Http\Controllers\balitaController;
use App\Http\Controllers\ibuController;
use App\Http\Controllers\LoginController;
use App\Models\Balita;
use App\Models\OrangTua;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('backend.pages.welcome');
});

// Hrus login
Route::middleware('auth')->group(function () {
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::middleware('role:admin')->group(function () {
        Route::get('/get-data-pengukuran', [balitaController::class, 'dataPengukuran'])->name('data.pengukuran');

    
        Route::get('/admin/dashboard', function () {
            return view('backend.admin.dashboard');
        })->name('admin.dashboard');

        
        Route::get('/admin/registrasi-ibu', function () {
            return view('backend.admin.ibu.registrasi_ibu');
        })->name('registrasi.balita');
        Route::post('/admin/registrasi-ibu', [ibuController::class, 'store'])->name('registrasi.ibu');

        Route::get('/admin/registrasi-balita', function () {
            $orangTuaList = OrangTua::all();
            return view('backend.admin.balita.registrasi_balita', compact('orangTuaList'));
        })->name('registrasi.balita');
        Route::post('/admin/registrasi-balita', [balitaController::class, 'store'])->name('registrasi.balita');


        Route::get('/admin/daftar-ibu', [ibuController::class, 'index'])->name('daftar_ibu');
        Route::get('/admin/detail-ibu/{id}', [ibuController::class, 'show'])->name('detail_ibu');
        Route::get('/admin/hapus-ibu/{id}', [ibuController::class, 'destroy'])->name('hapus.ibu');

        Route::get('/admin/daftar-balita', [balitaController::class, 'index'])->name('daftar_balita');
        Route::get('/admin/detail-balita/{id}', [balitaController::class, 'show'])->name('detail_balita');
        Route::get('/admin/hapus-balita/{id}', [balitaController::class, 'destroy'])->name('hapus.balita');
        Route::get('/admin/pengukuran-balita', [balitaController::class, 'showPengukuran'])->name('pengukuran');
        Route::post('/admin/pengukuran-balita/{id}', [balitaController::class, 'pengukuran'])->name('pengukuran.store');
    
    });
    Route::middleware('role:user')->group(function () {

        Route::get('ibu/dashboard', function () {
            return view('backend.ibu.dashboard');
        })->name('user.dashboard');
    });
});


Route::get('/login', function () {
    if (Auth::check()) {
        return redirect()->to('/admin/dashboard');
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
