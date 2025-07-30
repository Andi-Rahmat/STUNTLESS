<?php

namespace App\Http\Controllers;

use App\Models\OrangTua;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;


class LoginController extends Controller
{
    public function login(Request $request)
    {

        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('email', $credentials['email'])
            ->first();
        if (!$user || !hash::check($credentials['password'], $user->password)) {
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }
        Auth::login($user);
        return redirect()->to('/dashboard');
    }

    public function registrasi(Request $request)
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

        return redirect()->route('login');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
