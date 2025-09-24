<?php

use App\Http\Controllers\aiController;
use App\Http\Controllers\balitaController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\ibuController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\pengaturanController;
use App\Http\Controllers\pengukuranController;
use App\Models\Balita;
use App\Models\OrangTua;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


// Route::view('/chat', 'chat');                 // halaman UI sederhana
// Route::post('/chatAi', [aiController::class, 'chatAi']);       // non-stream
// Route::post('/api/chat', [aiController::class, 'chat']);       // non-stream
// Route::post('/api/chat/stream', [aiController::class, 'stream']);
Route::get('/', function () {
    return view('frontend.pages.welcome');
});

// Hrus login
Route::middleware('auth')->group(function () {
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/admin/pengukuran-balita', [pengukuranController::class, 'show'])->name('pengukuran');
    Route::post('/admin/pengukuran-balita/{id}', [pengukuranController::class, 'store'])->name('pengukuran.store');
    Route::get('/admin/hapus-pengukuran/{id}', [pengukuranController::class, 'destroy'])->name('hapus.pengukuran');
    Route::get('/modal/pengukuran/{id}', [pengukuranController::class, 'modal'])->name('modal.pengukuran');

    Route::get('/{role}/daftar-balita', [balitaController::class, 'index'])->name('daftar_balita');
    Route::get('/{role}/registrasi-balita', function () {
        $orangTuaList = cekRole() == 'admin' ? OrangTua::all() : OrangTua::find(userOrangTua()->id);
        return view('backend.admin.balita.registrasi_balita', compact('orangTuaList'));
    })->name('registrasi.balita');
    Route::post('/{role}/registrasi-balita', [balitaController::class, 'store'])->name('registrasi.balita');
    Route::get('/{role}/detail-balita/{id}', [balitaController::class, 'show'])->name('detail_balita');
    Route::get('/{role}/detail-balita/{id}/{idPengukuran}', [balitaController::class, 'show'])->name('detail_balita_pengukuran');
    Route::get('/{role}/hapus-balita/{id}', [balitaController::class, 'destroy'])->name('hapus_balita');

    



    Route::middleware('role:admin')->group(function () {
        Route::get('/get-data-pengukuran', [balitaController::class, 'dataPengukuran'])->name('data.pengukuran');

        Route::get('/admin/dashboard', [dashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/admin/registrasi-ibu', function () {
            return view('backend.admin.ibu.registrasi_ibu');
        })->name('registrasi.ibu');
        Route::post('/admin/registrasi-ibu', [ibuController::class, 'store'])->name('registrasi.ibu');

        Route::get('/admin/daftar-ibu', [ibuController::class, 'index'])->name('daftar_ibu');
        Route::get('/admin/detail-ibu/{id}', [ibuController::class, 'show'])->name('detail_ibu');
        Route::get('/admin/hapus-ibu/{id}', [ibuController::class, 'destroy'])->name('hapus.ibu');
        Route::get('/modal/perkembangan/{tahap}', [balitaController::class, 'modalPerkembangan'])->name('modalPerkembangan');
        Route::post('/admin/perkembangan/{id}', [balitaController::class, 'perkembangan']);

        // Route::get('/admin/detail-balita/{id}/{idPengukuran}', [balitaController::class, 'show'])->name('detail_balita_pengukuran');
        // Route::get('/admin/hapus-balita/{id}', [balitaController::class, 'destroy'])->name('hapus.balita');
        
    });
    
    Route::middleware('role:ibu')->group(function () {

        Route::get('/ibu/dashboard', [ibuController::class, 'dashboard'])->name('ibu.dashboard');
        // Route::get('/ibu/detail-balita/{id}/{idPengukuran}', [balitaController::class, 'show'])->name('user.detail_balita_pengukuran');
        Route::get('/ibu/profile', [ibuController::class, 'profile'])->name('ibu.profile');
        Route::post('/ibu/profile', [ibuController::class, 'edit'])->name('ibu.profile.edit');
    });
});


Route::get('/login', function () {
    if (Auth::check()) {
            return redirect()->to('/'.cekRole().'/dashboard');
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
