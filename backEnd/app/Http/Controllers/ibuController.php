<?php

namespace App\Http\Controllers;

use App\Models\Balita;
use App\Models\OrangTua;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ibuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataView['ibu'] = OrangTua::all();

        return view('backend.admin.ibu.daftar_ibu',['data' => $dataView]);
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
            'name'          => 'required|string|max:255',
            'alamat'        => 'required|string|max:255',
            'jenisKelamin'  => 'required|string|max:1',
            'tglLahir'      => 'required',
            'jumlahAnak'    => 'required',
            'noTelp'        => 'required',
            'nik'           => 'required|string|max:16|unique:orang_tua,nik',
            'email'         => 'required|email|unique:users,email',
            'password'      => 'required|string',
        ]);

        $tanggal = Carbon::createFromFormat('d/m/Y', $request->tglLahir)->format('Y-m-d');
        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'noTelp'     => $request->noTelp,
            'password'  => Hash::make($request->password),
        ]);

        OrangTua::create([
            'namaLengkap'   => $request->name,
            'tglLahir'      => $tanggal,
            'alamat'        => $request->alamat,
            'jenisKelamin'  => $request->jenisKelamin,
            'jumlahAnak'    => $request->jumlahAnak,
            'nik'           => $request->nik,
            'idUser'       => $user->id,
        ]);

        return redirect()->route('daftar_ibu')->with('success', 'Registrasi Ibu Berhasil');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {  
        $data['orangTua'] = OrangTua::find($id);

        return view('backend.admin.ibu.detail', $data);
        
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
        OrangTua::destroy($id);
        return redirect()->route('daftar_ibu')->with('warning', 'Data Balita Berhasil dihapus');
    }
}
