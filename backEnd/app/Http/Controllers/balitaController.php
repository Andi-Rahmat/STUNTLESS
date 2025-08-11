<?php

namespace App\Http\Controllers;

use App\Models\Balita;
use App\Models\DataIot;
use App\Models\OrangTua;
use App\Models\Pengukuran;
use App\Models\ZScore;
use Carbon\Carbon;
use Dotenv\Store\File\Paths;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class balitaController extends Controller
{


    public function dataIot(string $berat, string $tinggi, string $suhu, string $lingkar_kepala)
    {
        DataIot::create([
            'berat' => $berat ,
            'tinggi' => $tinggi ,
            'suhu' => $suhu,
            'lingkar_kepala' => $lingkar_kepala,
        ]);
        return response()->json('berat = '.$berat.'tinggi = '.$tinggi);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataView['balita'] = Balita::all();

        return view('backend.admin.balita.daftar_balita',['data' => $dataView]);
    }


public function dataPengukuran()
{
    $dataIot = DataIot::orderBy('id', 'desc')->first();

    return response()->json($dataIot);
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
                'jenisKelamin'  => 'required|in:L,P',
                'anakKe'        => 'required|integer',
                'golonganDarah' => 'required|in:A,B,AB,O',
                'idOrangTua'    => 'required|exists:orang_tua,id',
            ]);
            $tanggal = Carbon::createFromFormat('d/m/Y', $request->tglLahir)->format('Y-m-d');
            $balita = new Balita();
            $balita->namaLengkap    = $request->input('namaLengkap');
            $balita->NIK            = $request->input('NIK');
            $balita->tglLahir       = $tanggal;
            $balita->jenisKelamin   = $request->input('jenisKelamin');
            $balita->anak_ke        = $request->input('anakKe');
            $balita->golongan_darah = $request->input('golonganDarah');
            $balita->idOrangTua     = $request->input('idOrangTua');
            $balita->save();
    
            return redirect()->route('daftar_balita')->with('success', 'Registrasi Balita Berhasil');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, $idPengukuran = null)
    {  
        $dataWHO = require app_path('data/dataWHO.php');

        $indikator = request()->query('indikator','berat');
        $data['balita'] = Balita::find($id);
        $balita = $data['balita'];
        $tglLahir = $balita->tglLahir;
        $birthDateObj = Carbon::createFromFormat('Y-m-d', $tglLahir);
        $data['dataSekarang']   = $idPengukuran != null ? Pengukuran::where('idBalita',$id)->where('id', $idPengukuran)->orderBy('tglPengukuran', 'desc')->first() : (Pengukuran::where('idBalita', $id)->orderBy('tglPengukuran', 'desc')->first() ?? null);
        $data['dataSebelum']    = $idPengukuran != null ? Pengukuran::where('idBalita', $id)->where('id', '<', $idPengukuran)->orderBy('tglPengukuran', 'desc')->first() : (Pengukuran::where('idBalita', $id)->orderBy('tglPengukuran', 'desc')->skip(1)->first() ?? null);
        $data['riwayatPengukuran']    = Pengukuran::where('idBalita', $id)->orderBy('tglPengukuran', 'desc')->get();
        // Menghitung selisih usia dalam bulan
        $currentDate = $data['dataSekarang'] == null ? now() : Carbon::createFromFormat('Y-m-d', $data['dataSekarang']->tglPengukuran);
        $months = (int) $birthDateObj->diffInMonths($currentDate);
        $data['dataWHO']        = $indikator == 'berat/tinggi' ? $dataWHO[$indikator][$balita->jenisKelamin == 'L' ? 'laki-laki' : 'perempuan'][$months >= 24 ? 1 : 0][(float)$data['dataSekarang']->tinggi]
                                    : $dataWHO[$indikator][$balita->jenisKelamin == 'L' ? 'laki-laki' : 'perempuan'][$months];
        $data['indikator']      = $indikator;
        $data['dataListWHO'] = $dataWHO;
        return view('backend.admin.balita.detail', $data);
        
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
