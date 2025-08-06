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
    // $dataIot = DataIot::first();
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
            $balita->tglLahir       = $request->input('jenisKelamin');
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
        $dataWHO = require app_path('data/dataWHO.php');

        $data['balita'] = Balita::find($id);
        $balita = $data['balita'];
        $umur = $balita->tglLahir;
        $birthDateObj = Carbon::createFromFormat('Y-m-d', $umur);
        // Tanggal saat ini
        $currentDate = Carbon::now();
        // Menghitung selisih usia dalam bulan
        $months = (int) $birthDateObj->diffInMonths($currentDate);
        $data['dataSekarang'] = Pengukuran::where('idBalita', $id)->orderBy('tglPengukuran', 'desc')->first();
        $data['dataSebelum'] = Pengukuran::where('idBalita', $id)->orderBy('tglPengukuran', 'desc')->skip(1)->first();

        $data['dataWHO']    = $dataWHO['berat'][$balita->jenisKelamin == 'L' ? 'laki-laki' : 'perempuan'][$months];
        if($data['dataSekarang']->berat == $data['dataWHO']['SD0'] ){
            $zscore = ($data['dataSekarang']->berat - $data['dataWHO']['SD0']) / $data['dataWHO']['SD0']; 
        }elseif($data['dataSekarang']->berat < $data['dataWHO']['SD0']){
            $zscore = ($data['dataSekarang']->berat - $data['dataWHO']['SD0']) / ($data['dataWHO']['SD0'] - $data['dataWHO']['SD1neg']) ; 
        }else{
            $zscore = ($data['dataSekarang']->berat - $data['dataWHO']['SD0']) / ($data['dataWHO']['SD1'] - $data['dataWHO']['SD0']); 
        }
        dd($zscore);
        return view('backend.admin.balita.detail', $data);
        
    }

    public function showPengukuran()
    {  
        // dd($dataWHO['imt']['laki-laki'][3]);
        $balitaList = Balita::all();
        $id = request()->query('balita');
        if($id){
            $dataBalita = Balita::find($id);
            $dataIot    = DataIot::first();
        }
        
        return view('backend.admin.balita.pengukuran', compact('balitaList') + ($id != null ? ['dataBalita' => $dataBalita, 'dataIot' => $dataIot] : []));

    }

    public function pengukuran(Request $request,string $id)
    {
        $dataWHO = require app_path('data/dataWHO.php');

        $balita = Balita::find($id);
        $umur = $balita->tglLahir;
        $birthDateObj = Carbon::createFromFormat('Y-m-d', $umur);
        // Tanggal saat ini
        $currentDate = Carbon::now();
        // Menghitung selisih usia dalam bulan
        $months = (int) $birthDateObj->diffInMonths($currentDate);

        $IMT = $request->berat / (($request->tinggi/100) * ($request->tinggi/100));

        // hitung Zscore Berat
        $data['dataBerat']    = $dataWHO['berat'][$balita->jenisKelamin == 'L' ? 'laki-laki' : 'perempuan'][$months];

        if($request->berat == $data['dataBerat']['SD0'] ){
            $zscoreBerat = ($request->berat - $data['dataBerat']['SD0']) / $data['dataBerat']['SD0']; 
        }elseif($request->berat < $data['dataBerat']['SD0']){
            $zscoreBerat = ($request->berat - $data['dataBerat']['SD0']) / ($data['dataBerat']['SD0'] - $data['dataBerat']['SD1neg']) ; 
        }else{
            $zscoreBerat = ($request->berat - $data['dataBerat']['SD0']) / ($data['dataBerat']['SD1'] - $data['dataBerat']['SD0']); 
        }

    // hitung Zscore tinggi
        $data['dataTinggi']    = $dataWHO['tinggi'][$balita->jenisKelamin == 'L' ? 'laki-laki' : 'perempuan'][$months];
        
        if($request->tinggi == $data['dataTinggi']['SD0'] ){
            $zscoreTinggi = ($request->tinggi - $data['dataTinggi']['SD0']) / $data['dataTinggi']['SD0']; 
        }elseif($request->tinggi < $data['dataTinggi']['SD0']){
            $zscoreTinggi = ($request->tinggi - $data['dataTinggi']['SD0']) / ($data['dataTinggi']['SD0'] - $data['dataTinggi']['SD1neg']) ; 
        }else{
            $zscoreTinggi = ($request->tinggi - $data['dataTinggi']['SD0']) / ($data['dataTinggi']['SD1'] - $data['dataTinggi']['SD0']); 
        }
    // END 
    // hitung Zscore BERAT/TINGGI
        $data['dataBeratTinggi']    = $dataWHO['berat/tinggi'][$balita->jenisKelamin == 'L' ? 'laki-laki' : 'perempuan'][$months >= 24 ? 1 : 0][(float)$request->tinggi];
        if($request->berat == $data['dataBeratTinggi']['SD0'] ){
            $zscoreBeratTinggi = ($request->berat - $data['dataBeratTinggi']['SD0']) / $data['dataBeratTinggi']['SD0']; 
        }elseif($request->berat < $data['dataBeratTinggi']['SD0']){
            $zscoreBeratTinggi = ($request->berat - $data['dataBeratTinggi']['SD0']) / ($data['dataBeratTinggi']['SD0'] - $data['dataBeratTinggi']['SD1neg']) ; 
        }else{
            $zscoreBeratTinggi = ($request->berat - $data['dataBeratTinggi']['SD0']) / ($data['dataBeratTinggi']['SD1'] - $data['dataBeratTinggi']['SD0']); 
        }
    // end

    // hitung Zscore lingkarKepala
        // $data['dataLingkarKepala']    = $dataWHO['lingkarKepala'][$balita->jenisKelamin == 'L' ? 'laki-laki' : 'perempuan'][$months];
        
        // if($request->tinggi == $data['dataLingkarKepala']['SD0'] ){
        //     $zscoreBerattinggi = ($request->tinggi - $data['dataLingkarKepala']['SD0']) / $data['dataLingkarKepala']['SD0']; 
        // }elseif($request->tinggi < $data['dataLingkarKepala']['SD0']){
        //     $zscoreBerattinggi = ($request->tinggi - $data['dataLingkarKepala']['SD0']) / ($data['dataLingkarKepala']['SD0'] - $data['dataLingkarKepala']['SD1neg']) ; 
        // }else{
        //     $zscoreBerattinggi = ($request->tinggi - $data['dataLingkarKepala']['SD0']) / ($data['dataLingkarKepala']['SD1'] - $data['dataLingkarKepala']['SD0']); 
        // }
    // end

    // hitung Zscore imt
        $data['dataImt']    = $dataWHO['imt'][$balita->jenisKelamin == 'L' ? 'laki-laki' : 'perempuan'][$months];
        
        if($IMT == $data['dataImt']['SD0'] ){
            $zscoreIMT = ($IMT - $data['dataImt']['SD0']) / $data['dataImt']['SD0']; 
        }elseif($IMT < $data['dataImt']['SD0']){
            $zscoreIMT = ($IMT - $data['dataImt']['SD0']) / ($data['dataImt']['SD0'] - $data['dataImt']['SD1neg']) ; 
        }else{
            $zscoreIMT = ($IMT - $data['dataImt']['SD0']) / ($data['dataImt']['SD1'] - $data['dataImt']['SD0']); 
        }
    // end
        $sdBerat =Arr::except($data['dataBerat'], ["L", "M", "S"]);
        $sdTinggi =Arr::except($data['dataTinggi'], ["L", "M", "S"]);
        $sdBeratTinggi =Arr::except($data['dataBeratTinggi'], ["L", "M", "S"]);
        $sdImt =Arr::except($data['dataImt'], ["L", "M", "S"]);

        $idPengukuran = Pengukuran::create([
            'idBalita'          => $id,
            'tglPengukuran'     => $request->tglPengukuran, 
            'berat'             => $request->berat, 
            'tinggi'            => $request->tinggi, 
            'suhu'              => $request->suhu,
            'lingkar_kepala'    => $request->lingkar_kepala, 
            'IMT'               => $IMT,
        ]);

        ZScore::create([
            'beratSd'               => checkSD($zscoreBerat,$sdBerat),
            'berat'                 => $zscoreBerat,
            'tinggiSd'              => checkSD($zscoreTinggi,$sdTinggi),
            'tinggi'                => $zscoreTinggi,
            'beratTinggiSd'         => checkSD($zscoreBeratTinggi,$sdBeratTinggi),
            'beratTinggi'           => $zscoreBeratTinggi,
            'lingkar_kepalaSd'      => checkSD($zscoreBeratTinggi,$sdBeratTinggi),
            'lingkar_kepala'        => $zscoreBeratTinggi,
            'imtSd'                 => checkSD($zscoreIMT,$sdImt),
            'imt'                   => $zscoreIMT,
            'idPengukuran'          => $idPengukuran->id,
        ]);

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
