<?php

use Illuminate\Support\Facades\Auth;

if (!function_exists('hitungUsia')) {
    /**
     * Fungsi untuk menghitung usia berdasarkan tanggal lahir
     *
     * @param string $birthdate Tanggal lahir dalam format 'Y-m-d'
     * @return int Usia
     */
    function hitungUsia($birthdate)
    {
        $birthDate = new \DateTime($birthdate);
        $today = new \DateTime();
        $age = $today->diff($birthDate);

        return $age->y . ' tahun ' . $age->m . ' bulan';
    }
}

if (!function_exists('cekRole')) {
    /**
     * Fungsi untuk menghitung usia berdasarkan tanggal lahir
     *
     * @param string $birthdate Tanggal lahir dalam format 'Y-m-d'
     * @return int Usia
     */
    function cekRole()
    {
        $role = Auth::user()->role;

        return $role;
    }
}
