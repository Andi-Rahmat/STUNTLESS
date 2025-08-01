<?php

namespace App\Http\Controllers;

use App\Models\Balita;
use App\Models\DataIot;
use App\Models\OrangTua;
use Carbon\Carbon;
use Illuminate\Http\Request;

class balitaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataView['balita'] = Balita::all();

        return view('backend.admin.balita.daftar_balita',['data' => $dataView]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            $request->validate([
                'namaLengkap'   => 'required|string|max:255',
                'NIK'           => 'required|numeric|unique:balita,NIK',
                'tglLahir'      => 'required|date',
                'anakKe'        => 'required|integer',
                'golonganDarah' => 'required|in:A,B,AB,O',
                'idOrangTua'    => 'required|exists:orang_tua,id',
            ]);
            $tanggal = Carbon::createFromFormat('d/m/Y', $request->tglLahir)->format('Y-m-d');
            $balita = new Balita();
            $balita->namaLengkap    = $request->input('namaLengkap');
            $balita->NIK            = $request->input('NIK');
            $balita->tglLahir       = $tanggal;
            $balita->anak_ke        = $request->input('anakKe');
            $balita->golongan_darah = $request->input('golonganDarah');
            $balita->idOrangTua     = $request->input('idOrangTua');
            $balita->save();
    
            return redirect()->route('daftar_balita')->with('success', 'Registrasi Balita Berhasil');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {  
        $data['balita'] = Balita::find($id);

        return view('backend.admin.balita.detail', $data);
        
    }

    public function showPengukuran()
    {  
        $balitaList = Balita::all();
        $id = request()->query('balita');
        if($id){
            $dataBalita = Balita::find($id);
            $dataIot    = DataIot::first();
        }
        
        return view('backend.admin.balita.pengukuran', compact('balitaList', 'dataBalita', 'dataIot'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Balita::destroy($id);
        return redirect()->route('daftar_balita')->with('warning', 'Data Balita Berhasil dihapus');
    }
}
