<?php

namespace App\Http\Controllers;

use App\Models\Balita;
use App\Models\DataIot;
use App\Models\Pengukuran;
use App\Models\User;
use App\Models\ZScore;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class pengukuranController extends Controller
{
    public function show()
    {  
        $balitaList = Balita::all();
        if (Auth::user()->role == 'admin') {
            $balitaList = Balita::all();
        } else {
            $balitaList = Balita::where('idOrangTua',userOrangTua()->orangTua->id)->get();
        }
        $id = request()->query('balita');
        if($id){
            $dataBalita = Balita::find($id);
            $dataIot    = DataIot::first();
        }
        
        return view('backend.admin.balita.pengukuran', compact('balitaList') + ($id != null ? ['dataBalita' => $dataBalita, 'dataIot' => $dataIot] : []));

    }

    public function store(Request $request,string $id)
    {
        $dataWHO = require app_path('data/dataWHO.php');

        $balita = Balita::find($id);
        $umur = $balita->tglLahir;
        $birthDateObj = Carbon::createFromFormat('Y-m-d', $umur);
        // Tanggal saat ini
        $currentDate = Carbon::now();
        // Menghitung selisih usia dalam bulan
        $months = (int) $birthDateObj->diffInMonths($currentDate);

        $IMT =number_format($request->berat / (($request->tinggi/100) * ($request->tinggi/100)),3);

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
            'imt'               => $IMT,
        ]);

        ZScore::create([
            'beratSd'               => checkSD($request->berat,$sdBerat),
            'berat'                 => $zscoreBerat,
            'tinggiSd'              => checkSD($request->tinggi,$sdTinggi),
            'tinggi'                => $zscoreTinggi,
            'berat/tinggiSd'         => checkSD($request->berat,$sdBeratTinggi),
            'berat/tinggi'           => $zscoreBeratTinggi,
            'lingkar_kepalaSd'      => checkSD($request->Berat,$sdBeratTinggi),
            'lingkar_kepala'        => $zscoreBeratTinggi,
            'imtSd'                 => checkSD($IMT,$sdImt),
            'imt'                   => $zscoreIMT,
            'idPengukuran'          => $idPengukuran->id,
        ]);

        return redirect()->route('detail_balita_pengukuran', ['id' => $id, 'idPengukuran' => $idPengukuran->id])
            ->with('success', 'Pengukuran berhasil disimpan.');
    }
}
