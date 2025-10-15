<?php

namespace App\Http\Controllers;

use App\Models\Balita;
use App\Models\DataIot;
use App\Models\LingkarKepala;
use App\Models\Pengukuran;
use App\Models\User;
use App\Models\ZScore;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class pengukuranController extends Controller
{

    public function dataIot(string $berat, string $tinggi, string $suhu, string $lingkar_kepala)
    {
        DataIot::create([
            'berat' => $berat,
            'tinggi' => $tinggi,
            'suhu' => $suhu,
            'lingkar_kepala' => $lingkar_kepala,
        ]);
        return response()->json('berat = ' . $berat . 'tinggi = ' . $tinggi);
    }

        public function dataPengukuran()
    {
        $dataIot = DataIot::orderBy('id', 'desc')->first();
        $dataIot['lingkarKepala'] = optional(LingkarKepala::orderBy('id', 'desc')->first())->lingkarKepala;
        $dataIot['imgLingkarKepala'] = asset('storage/images/kepala.png');
        return response()->json($dataIot);
    }

    public function show()
    {
        $balitaList = Balita::all();
        if (Auth::user()->role == 'admin') {
            $balitaList = Balita::all();
        } else {
            $balitaList = Balita::where('idOrangTua', userOrangTua()->id)->get();
        }
        $id = request()->query('balita');
        if ($id) {
            $dataBalita = Balita::find($id);
            $dataIot    = DataIot::first();
        }

        return view('backend.admin.balita.pengukuran', compact('balitaList') + ($id != null ? ['dataBalita' => $dataBalita, 'dataIot' => $dataIot] : []));
    }

    public function store(Request $request, string $id)
    {
        $dataWHO = require app_path('data/dataWHO.php');

        $balita = Balita::find($id);
        $umur = $balita->tglLahir;
        $birthDateObj = Carbon::createFromFormat('Y-m-d', $umur);
        // Tanggal saat ini
        $currentDate = $request->tglPengukuran ? Carbon::createFromFormat('Y-m-d', $request->tglPengukuran) : Carbon::now();
        // Menghitung selisih usia dalam bulan
        $months = (int) $birthDateObj->diffInMonths($currentDate);

        $IMT = number_format($request->berat / (($request->tinggi / 100) * ($request->tinggi / 100)), 3);

        // hitung Zscore Berat
        $data['dataBerat']    = $dataWHO['berat'][$balita->jenisKelamin == 'L' ? 'laki-laki' : 'perempuan'][$months];
        if ($request->berat == $data['dataBerat']['SD0']) {
            $zscoreBerat = ($request->berat - $data['dataBerat']['SD0']) / $data['dataBerat']['SD0'];
        } elseif ($request->berat < $data['dataBerat']['SD0']) {
            $zscoreBerat = ($request->berat - $data['dataBerat']['SD0']) / ($data['dataBerat']['SD0'] - $data['dataBerat']['SD1neg']);
        } else {
            $zscoreBerat = ($request->berat - $data['dataBerat']['SD0']) / ($data['dataBerat']['SD1'] - $data['dataBerat']['SD0']);
        }

        // hitung Zscore tinggi
        $data['dataTinggi']    = $dataWHO['tinggi'][$balita->jenisKelamin == 'L' ? 'laki-laki' : 'perempuan'][$months];

        if ($request->tinggi == $data['dataTinggi']['SD0']) {
            $zscoreTinggi = ($request->tinggi - $data['dataTinggi']['SD0']) / $data['dataTinggi']['SD0'];
        } elseif ($request->tinggi < $data['dataTinggi']['SD0']) {
            $zscoreTinggi = ($request->tinggi - $data['dataTinggi']['SD0']) / ($data['dataTinggi']['SD0'] - $data['dataTinggi']['SD1neg']);
        } else {
            $zscoreTinggi = ($request->tinggi - $data['dataTinggi']['SD0']) / ($data['dataTinggi']['SD1'] - $data['dataTinggi']['SD0']);
        }
        // END 
        // hitung Zscore BERAT/TINGGI
        $batasTinggiWHO = $months >= 24 ? 119 : 110;
        $data['dataBeratTinggi']    = $dataWHO['berat/tinggi'][$balita->jenisKelamin == 'L' ? 'laki-laki' : 'perempuan'][$months >= 24 ? 1 : 0][(float)$request->tinggi > $batasTinggiWHO ? $batasTinggiWHO : $request->tinggi];
        if ($request->berat == $data['dataBeratTinggi']['SD0']) {
            $zscoreBeratTinggi = ($request->berat - $data['dataBeratTinggi']['SD0']) / $data['dataBeratTinggi']['SD0'];
        } elseif ($request->berat < $data['dataBeratTinggi']['SD0']) {
            $zscoreBeratTinggi = ($request->berat - $data['dataBeratTinggi']['SD0']) / ($data['dataBeratTinggi']['SD0'] - $data['dataBeratTinggi']['SD1neg']);
        } else {
            $zscoreBeratTinggi = ($request->berat - $data['dataBeratTinggi']['SD0']) / ($data['dataBeratTinggi']['SD1'] - $data['dataBeratTinggi']['SD0']);
        }
        // end

        // hitung Zscore lingkarKepala
        $data['dataLingkarKepala']    = $dataWHO['lingkarKepala'][$balita->jenisKelamin == 'L' ? 'laki-laki' : 'perempuan'][$months];

        if ($request->lingkarKepala == $data['dataLingkarKepala']['SD0']) {
            $zscoreLingkarKepala = ($request->lingkarKepala - $data['dataLingkarKepala']['SD0']) / $data['dataLingkarKepala']['SD0'];
        } elseif ($request->lingkarKepala < $data['dataLingkarKepala']['SD0']) {
            $zscoreLingkarKepala = ($request->lingkarKepala - $data['dataLingkarKepala']['SD0']) / ($data['dataLingkarKepala']['SD0'] - $data['dataLingkarKepala']['SD1neg']);
        } else {
            $zscoreLingkarKepala = ($request->lingkarKepala - $data['dataLingkarKepala']['SD0']) / ($data['dataLingkarKepala']['SD1'] - $data['dataLingkarKepala']['SD0']);
        }
        // end

        // hitung Zscore imt
        $data['dataImt']    = $dataWHO['imt'][$balita->jenisKelamin == 'L' ? 'laki-laki' : 'perempuan'][$months];

        if ($IMT == $data['dataImt']['SD0']) {
            $zscoreIMT = ($IMT - $data['dataImt']['SD0']) / $data['dataImt']['SD0'];
        } elseif ($IMT < $data['dataImt']['SD0']) {
            $zscoreIMT = ($IMT - $data['dataImt']['SD0']) / ($data['dataImt']['SD0'] - $data['dataImt']['SD1neg']);
        } else {
            $zscoreIMT = ($IMT - $data['dataImt']['SD0']) / ($data['dataImt']['SD1'] - $data['dataImt']['SD0']);
        }
        // end
        $sdBerat = Arr::except($data['dataBerat'], ["L", "M", "S"]);
        $sdTinggi = Arr::except($data['dataTinggi'], ["L", "M", "S"]);
        $sdBeratTinggi = Arr::except($data['dataBeratTinggi'], ["L", "M", "S"]);
        $sdLingkarKepala = Arr::except($data['dataLingkarKepala'], ["L", "M", "S"]);
        $sdImt = Arr::except($data['dataImt'], ["L", "M", "S"]);

        $idPengukuran = Pengukuran::create([
            'idBalita'          => $id,
            'tglPengukuran'     => $request->tglPengukuran,
            'berat'             => $request->berat,
            'tinggi'            => $request->tinggi,
            'suhu'              => $request->suhu,
            'lingkarKepala'     =>  $request->lingkarKepala,
            'imt'               => $IMT,
        ]);

        ZScore::create([
            'beratSd'               => checkSD($request->berat, $sdBerat),
            'berat'                 => $zscoreBerat,
            'tinggiSd'              => checkSD($request->tinggi, $sdTinggi),
            'tinggi'                => $zscoreTinggi,
            'berat/tinggiSd'         => checkSD($request->berat, $sdBeratTinggi),
            'berat/tinggi'           => $zscoreBeratTinggi,
            'lingkarKepalaSd'      => checkSD($request->lingkarKepala, $sdLingkarKepala),
            'lingkarKepala'        => $zscoreLingkarKepala,
            'imtSd'                 => checkSD($IMT, $sdImt),
            'imt'                   => $zscoreIMT,
            'idPengukuran'          => $idPengukuran->id,
        ]);

        return redirect()->route('detail_balita_pengukuran', ['role' => cekRole(), 'id' => $id, 'idPengukuran' => $idPengukuran->id])
            ->with('success', 'Pengukuran berhasil disimpan.');
    }

    public function destroy(int $id)
    {
        $pengukuran = Pengukuran::find($id);
        if ($pengukuran) {
            $pengukuran->delete();
            return redirect()->route('detail_balita', ['role' => cekRole(), 'id' => $id])->with('warning', 'Pengukuran berhasil dihapus.');
        } else {
            return redirect()->back()->with('error', 'Pengukuran tidak ditemukan.');
        }
    }

    public function modal(int $id)
    {
        $pengukuran = Pengukuran::with('zscore')->find($id);
        if ($pengukuran) {
            return response()->json([
                'status' => 'success',
                'data' => $pengukuran
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Pengukuran tidak ditemukan.'
            ]);
        }
    }

    public function gambar(Request $request)
    {
        // Validasi file yang diupload
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5048', // Aturan validasi file
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Gambar gagal diupload, tipe tidak sesuai!',
            ]);
        }

        // Ambil file gambar yang diupload
        $image = $request->file('image');
        // Buat nama file baru menggunakan timestamp dan nama asli file untuk menghindari duplikasi
        $filename = 'kepala.' . $image->getClientOriginalExtension();
        // Menyimpan gambar ke storage dengan nama file baru
        $path = $image->storeAs('images', $filename, 'public');  // Gambar akan disimpan di folder 'storage/app/public/images'

        // Mendapatkan URL public untuk gambar yang disimpan
        $url = Storage::url($path);
        // Menampilkan hasil upload atau dapat disesuaikan dengan logika lain
        return response()->json([
            'message' => 'Gambar berhasil diupload!',
            'path' => $url,
        ]);
    }

    public function ukurLingkarKepala(string $lingkarKepala)
    {
        LingkarKepala::create([
            'lingkarKepala' => $lingkarKepala,
        ]);
        return response()->json('data lk = '.$lingkarKepala.', berhasil');
    
    }

    public function feGiziForm(Request $request)
    {
        $dataWHO = require app_path('data/dataWHO.php');
        $months = $request->input('umur');
         $IMT = number_format($request->berat / (($request->tinggi / 100) * ($request->tinggi / 100)), 3);

        // hitung Zscore Berat
        $data['dataBerat']    = $dataWHO['berat'][$request->jenisKelamin == 'L' ? 'laki-laki' : 'perempuan'][$months];
        if ($request->berat == $data['dataBerat']['SD0']) {
            $zscoreBerat = ($request->berat - $data['dataBerat']['SD0']) / $data['dataBerat']['SD0'];
        } elseif ($request->berat < $data['dataBerat']['SD0']) {
            $zscoreBerat = ($request->berat - $data['dataBerat']['SD0']) / ($data['dataBerat']['SD0'] - $data['dataBerat']['SD1neg']);
        } else {
            $zscoreBerat = ($request->berat - $data['dataBerat']['SD0']) / ($data['dataBerat']['SD1'] - $data['dataBerat']['SD0']);
        }

        // hitung Zscore tinggi
        $data['dataTinggi']    = $dataWHO['tinggi'][$request->jenisKelamin == 'L' ? 'laki-laki' : 'perempuan'][$months];

        if ($request->tinggi == $data['dataTinggi']['SD0']) {
            $zscoreTinggi = ($request->tinggi - $data['dataTinggi']['SD0']) / $data['dataTinggi']['SD0'];
        } elseif ($request->tinggi < $data['dataTinggi']['SD0']) {
            $zscoreTinggi = ($request->tinggi - $data['dataTinggi']['SD0']) / ($data['dataTinggi']['SD0'] - $data['dataTinggi']['SD1neg']);
        } else {
            $zscoreTinggi = ($request->tinggi - $data['dataTinggi']['SD0']) / ($data['dataTinggi']['SD1'] - $data['dataTinggi']['SD0']);
        }
        // END 
        // hitung Zscore BERAT/TINGGI
        $data['dataBeratTinggi']    = $dataWHO['berat/tinggi'][$request->jenisKelamin == 'L' ? 'laki-laki' : 'perempuan'][$months >= 24 ? 1 : 0][(float)$request->tinggi];
        if ($request->berat == $data['dataBeratTinggi']['SD0']) {
            $zscoreBeratTinggi = ($request->berat - $data['dataBeratTinggi']['SD0']) / $data['dataBeratTinggi']['SD0'];
        } elseif ($request->berat < $data['dataBeratTinggi']['SD0']) {
            $zscoreBeratTinggi = ($request->berat - $data['dataBeratTinggi']['SD0']) / ($data['dataBeratTinggi']['SD0'] - $data['dataBeratTinggi']['SD1neg']);
        } else {
            $zscoreBeratTinggi = ($request->berat - $data['dataBeratTinggi']['SD0']) / ($data['dataBeratTinggi']['SD1'] - $data['dataBeratTinggi']['SD0']);
        }
        // end

        // hitung Zscore lingkarKepala
        $data['dataLingkarKepala']    = $dataWHO['lingkarKepala'][$request->jenisKelamin == 'L' ? 'laki-laki' : 'perempuan'][$months];

        if ($request->lingkarKepala == $data['dataLingkarKepala']['SD0']) {
            $zscoreLingkarKepala = ($request->lingkarKepala - $data['dataLingkarKepala']['SD0']) / $data['dataLingkarKepala']['SD0'];
        } elseif ($request->lingkarKepala < $data['dataLingkarKepala']['SD0']) {
            $zscoreLingkarKepala = ($request->lingkarKepala - $data['dataLingkarKepala']['SD0']) / ($data['dataLingkarKepala']['SD0'] - $data['dataLingkarKepala']['SD1neg']);
        } else {
            $zscoreLingkarKepala = ($request->lingkarKepala - $data['dataLingkarKepala']['SD0']) / ($data['dataLingkarKepala']['SD1'] - $data['dataLingkarKepala']['SD0']);
        }
        // end

        // hitung Zscore imt
        $data['dataImt']    = $dataWHO['imt'][$request->jenisKelamin == 'L' ? 'laki-laki' : 'perempuan'][$months];

        if ($IMT == $data['dataImt']['SD0']) {
            $zscoreIMT = ($IMT - $data['dataImt']['SD0']) / $data['dataImt']['SD0'];
        } elseif ($IMT < $data['dataImt']['SD0']) {
            $zscoreIMT = ($IMT - $data['dataImt']['SD0']) / ($data['dataImt']['SD0'] - $data['dataImt']['SD1neg']);
        } else {
            $zscoreIMT = ($IMT - $data['dataImt']['SD0']) / ($data['dataImt']['SD1'] - $data['dataImt']['SD0']);
        }
        // // end
        // $sdBerat = Arr::except($data['dataBerat'], ["L", "M", "S"]);
        // $sdTinggi = Arr::except($data['dataTinggi'], ["L", "M", "S"]);
        // $sdBeratTinggi = Arr::except($data['dataBeratTinggi'], ["L", "M", "S"]);
        // $sdLingkarKepala = Arr::except($data['dataLingkarKepala'], ["L", "M", "S"]);
        // $sdImt = Arr::except($data['dataImt'], ["L", "M", "S"]);

        return response()->json([
            'message' => 'Data berhasil diterima',
            'berat' => $zscoreBerat,
            'tinggi' => $zscoreTinggi,
            'beratTinggi' => $zscoreBeratTinggi,
            'IMT' => $zscoreIMT,
            'lingkarKepala' => $zscoreLingkarKepala,
            'giziberat' => checkIndikator($zscoreBerat,"berat"),
            'gizitinggi' => checkIndikator($zscoreTinggi,"tinggi"),
            'giziberatTinggi' => checkIndikator($zscoreBeratTinggi,"berat/tinggi"),
            'giziIMT' => checkIndikator($zscoreIMT,"imt"),
            'gizilingkarKepala' => checkIndikator($zscoreLingkarKepala,"lingkarKepala"),
        ]);

    }
}
