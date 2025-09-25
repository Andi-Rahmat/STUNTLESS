<?php

use App\Http\Controllers\aiController;
use App\Http\Controllers\balitaController;
use App\Http\Controllers\pengukuranController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/data-iot/{berat}/{tinggi}/{suhu}/{lingkarKepala}', [pengukuranController::class, 'dataIot']);
Route::get('/data-lingkar-kepala/{lingkarKepala}', [pengukuranController::class, 'ukurLingkarKepala']);
Route::post('/upGambar', [pengukuranController::class, 'gambar']);
Route::post('/giziForm', [pengukuranController::class, 'feGiziForm']);
Route::post('/chatAi', [aiController::class, 'chatAi']);       // non-stream

