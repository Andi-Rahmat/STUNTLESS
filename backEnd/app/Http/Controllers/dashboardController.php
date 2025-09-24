<?php

namespace App\Http\Controllers;

use App\Models\Balita;
use App\Models\OrangTua;
use App\Models\Pengukuran;
use Illuminate\Http\Request;

class dashboardController extends Controller
{
    public function index()
    {
        $orangTuaList = cekRole() == 'admin' ? OrangTua::all() : OrangTua::find(userOrangTua()->id);
        $balitaList = Balita::all();
        $pengukuranList = Pengukuran::all();
        $pengukuranToday = Pengukuran::whereDate('created_at', today())->get();
        return view('backend.admin.dashboard', compact('orangTuaList', 'balitaList', 'pengukuranList', 'pengukuranToday'));
    }
}
