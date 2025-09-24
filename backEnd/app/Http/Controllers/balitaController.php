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
use Illuminate\Support\Facades\Auth;

class balitaController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataView['balita'] = [];
        if (cekRole() == 'admin') {
            $dataView['balita'] = Balita::all();
        } else {
            $dataView['balita'] = Balita::where('idOrangTua', userOrangTua()->id)->get();
        }

        return view('backend.admin.balita.daftar_balita', ['data' => $dataView]);
    }




    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

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
            'idOrangTua'    => 'required|exists:orang_tua,id',
        ]);

        $tanggal = Carbon::createFromFormat('d/m/Y', $request->tglLahir)->format('Y-m-d');
        $balita = new Balita();
        $balita->namaLengkap    = $request->input('namaLengkap');
        $balita->NIK            = $request->input('NIK');
        $balita->tglLahir       = $tanggal;
        $balita->jenisKelamin   = $request->input('jenisKelamin');
        $balita->golongan_darah = $request->input('golonganDarah') ?? null;
        $balita->idOrangTua     = $request->input('idOrangTua');
        $balita->save();

        return redirect()->route('daftar_balita', ['role' => cekRole()])->with('success', 'Registrasi Balita Berhasil');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $role, $id, $idPengukuran = null)
    {
        if (Auth::user()->role == 'ibu') {
            if (Balita::where('idOrangTua', userOrangTua()->id)->where('id', $id)->count() == 0) {
                return redirect()->back();
            }
        } else {
            if (Balita::where('id', $id)->count() == 0) {
                return redirect()->back();
            }
        }
        // dd($idPengukuran, $id, $role);
        $dataWHO = require app_path('data/dataWHO.php');
        $indikator = request()->query('indikator', 'berat');
        $data['balita'] = Balita::find($id);
        $balita = $data['balita'];
        $tglLahir = $balita->tglLahir;
        $birthDateObj = Carbon::createFromFormat('Y-m-d', $tglLahir);
        $data['dataSekarang']   = $idPengukuran != null ? Pengukuran::where('idBalita', $id)->where('id', $idPengukuran)->orderBy('tglPengukuran', 'desc')->first() : (Pengukuran::where('idBalita', $id)->orderBy('tglPengukuran', 'desc')->first() ?? null);
        $data['dataSebelum']    = $idPengukuran != null ? Pengukuran::where('idBalita', $id)->where('id', '<', $idPengukuran)->orderBy('tglPengukuran', 'desc')->first() : (Pengukuran::where('idBalita', $id)->orderBy('tglPengukuran', 'desc')->skip(1)->first() ?? null);
        $data['riwayatPengukuran']    = Pengukuran::where('idBalita', $id)->orderBy('tglPengukuran', 'desc')->get();
        // Menghitung selisih usia dalam bulan
        $currentDate = $data['dataSekarang'] == null ? now() : Carbon::createFromFormat('Y-m-d', $data['dataSekarang']->tglPengukuran);
        $months = (int) $birthDateObj->diffInMonths($currentDate);
        if ($data['dataSekarang']) {
            $data['dataWHO']        = $indikator == 'berat/tinggi' ? $dataWHO[$indikator][$balita->jenisKelamin == 'L' ? 'laki-laki' : 'perempuan'][$months >= 24 ? 1 : 0][(float)$data['dataSekarang']->tinggi]
                : $dataWHO[$indikator][$balita->jenisKelamin == 'L' ? 'laki-laki' : 'perempuan'][$months];
        }
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
    public function destroy(string $role, $id)
    {
        Balita::destroy($id);
        return redirect()->route('daftar_balita', ['role' => cekRole()])->with('warning', 'Data Balita Berhasil dihapus');;
    }
    public function modalPerkembangan($tahap)
    {
        $datakpsp = require app_path('data/kpsp.php');
        $dataMotorik = '<form action="">';
        $i = 1;
        foreach($datakpsp[$tahap.'_bulan']['Motorik']['pertanyaan'] as $motorik){
        $dataMotorik .= '
                <div class="card">
                    <div class="card-body">
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingMotorik'.$i.'">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseMotorik'.$i.'" aria-expanded="false" aria-controls="collapseMotorik'.$i.'">
                                    '.$motorik.'
                                    </button>
                                </h2>
                                <div id="collapseMotorik'.$i.'" class="accordion-collapse collapse" aria-labelledby="headingMotorik'.$i.'" data-bs-parent="#accordionExample">
                                    <div class="accordion-body text-center">
                                        <img class="mb-3" src="https://www.shutterstock.com/shutterstock/photos/134640377/display_1500/stock-photo-cute-baby-boy-over-white-background-134640377.jpg" alt="" width="250">
                                        <div class="d-flex w-100 justify-content-center align-items-center flex-column">
                                            <div class="btn-group-vertical w-75" role="group">
                                                <input type="radio" class="btn-check" name="radio_Motorik'.$i.'" id="yes_Motorik'.$i.'" autocomplete="off">
                                                <label class="btn btn-outline-success mb-2 rounded-pill" for="yes_Motorik'.$i.'">
                                                    <i class="fas fa-smile me-2"></i> Ya
                                                </label>

                                                <input type="radio" class="btn-check" name="radio_Motorik'.$i.'" id="no_Motorik'.$i.'" autocomplete="off">
                                                <label class="btn btn-outline-danger rounded-pill" for="no_Motorik'.$i.'">
                                                    <i class="fas fa-frown me-2"></i> Tidak
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        ';
        $i++;
        }
        $dataMotorik .= '</form>';

        $dataKognitif = '<form action="">';
        $i = 1;
        foreach($datakpsp[$tahap.'_bulan']['Kognitif']['pertanyaan'] as $kognitif){
        $dataKognitif .= '
                <div class="card">
                    <div class="card-body">
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingKognitif'.$i.'">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseKognitif'.$i.'" aria-expanded="false" aria-controls="collapseKognitif'.$i.'">
                                    '.$kognitif.'
                                    </button>
                                </h2>
                                <div id="collapseKognitif'.$i.'" class="accordion-collapse collapse" aria-labelledby="headingKognitif'.$i.'" data-bs-parent="#accordionExample">
                                    <div class="accordion-body text-center">
                                        <img class="text-center" src="assets/img/Asset/Stuntless FIX.png" alt="" width="250">
                                        <div class="d-flex w-100 justify-content-center align-items-center flex-column">
                                            <div class="btn-group-vertical w-75" role="group">
                                                <input type="radio" class="btn-check" name="radio_Kognitif'.$i.'" id="yes_Kognitif'.$i.'" autocomplete="off">
                                                <label class="btn btn-outline-success mb-2 rounded-pill" for="yes_Kognitif'.$i.'">
                                                    <i class="fas fa-smile me-2"></i> Ya
                                                </label>

                                                <input type="radio" class="btn-check" name="radio_Kognitif'.$i.'" id="no_Kognitif'.$i.'" autocomplete="off">
                                                <label class="btn btn-outline-danger rounded-pill" for="no_Kognitif'.$i.'">
                                                    <i class="fas fa-frown me-2"></i> Tidak
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        ';
        $i++;
        }
        $dataKognitif .= '</form>';

        $dataSosial = '<form action="">';
        $i = 1;
        foreach($datakpsp[$tahap.'_bulan']['Sosial']['pertanyaan'] as $sosial){
        $dataSosial .= '
                <div class="card">
                    <div class="card-body">
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingSosial'.$i.'">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSosial'.$i.'" aria-expanded="false" aria-controls="collapseSosial'.$i.'">
                                    '.$sosial.'
                                    </button>
                                </h2>
                                <div id="collapseSosial'.$i.'" class="accordion-collapse collapse" aria-labelledby="headingSosial'.$i.'" data-bs-parent="#accordionExample">
                                    <div class="accordion-body text-center">
                                        <img class="text-center" src="assets/img/Asset/Stuntless FIX.png" alt="" width="250">
                                        <div class="d-flex w-100 justify-content-center align-items-center flex-column">
                                            <div class="btn-group-vertical w-75" role="group">
                                                <input type="radio" class="btn-check" name="radio_Sosial'.$i.'" id="yes_Sosial'.$i.'" autocomplete="off">
                                                <label class="btn btn-outline-success mb-2 rounded-pill" for="yes_Sosial'.$i.'">
                                                    <i class="fas fa-smile me-2"></i> Ya
                                                </label>

                                                <input type="radio" class="btn-check" name="radio_Sosial'.$i.'" id="no_Sosial'.$i.'" autocomplete="off">
                                                <label class="btn btn-outline-danger rounded-pill" for="no_Sosial'.$i.'">
                                                    <i class="fas fa-frown me-2"></i> Tidak
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        ';
        $i++;
        }
        $dataSosial .= '</form>';

        return response()->json([
            'status'    => 'success',
            'motorik'   => $dataMotorik,
            'kognitif'  => $dataKognitif,
            'sosial'    => $dataSosial,
        ]);
    }
}
