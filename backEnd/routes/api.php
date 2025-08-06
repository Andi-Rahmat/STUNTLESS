<?php

use App\Http\Controllers\balitaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/data-iot/{berat}/{tinggi}/{suhu}/{lingkarKepala}', [balitaController::class, 'dataIot']);
