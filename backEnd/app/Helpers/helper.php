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

if (!function_exists('checkSD')) {
    /**
     * Fungsi untuk menghitung usia berdasarkan tanggal lahir
     *
     * @param string $birthdate Tanggal lahir dalam format 'Y-m-d'
     * @return int Usia
     */
    function checkSD($nilai, array $sdData)
    {
        $kategori = '';

        foreach ($sdData as $key => $value) {
            if ($nilai <= $value) {
                $kategori = $key;
                break;
            }
        }
        return $kategori;
    }
}
if (!function_exists('checkIndikator')) {
    /**
     * Fungsi untuk menghitung usia berdasarkan tanggal lahir
     *
     * @param string $birthdate Tanggal lahir dalam format 'Y-m-d'
     * @return int Usia
     */
    function checkIndikator($nilai, $jenis)
    {
        
        $result = '';

        switch ($jenis) {
            case 'berat':
                if ($nilai < -3.0) {
                    $result = 'Gizi Buruk';
                } elseif ($nilai >= -3.0 && $nilai < -2.0) {
                    $result = 'Gizi Kurang';
                } elseif ($nilai >= -2.0 && $nilai <= 2.0) {
                    $result = 'Gizi Baik';
                } else {
                    $result = 'Gizi Lebih';
                }
                break;

            case 'tinggi':
                if ($nilai < -3.0) {
                    $result = 'Sangat Pendek';
                } elseif ($nilai >= -3.0 && $nilai < -2.0) {
                    $result = 'Pendek';
                } elseif ($nilai >= -2.0 && $nilai <= 2.0) {
                    $result = 'Normal';
                }
                break;

            case 'berat/tinggi':
                if ($nilai < -3.0) {
                    $result = 'Sangat Kurus';
                } elseif ($nilai >= -3.0 && $nilai < -2.0) {
                    $result = 'Kurus';
                } elseif ($nilai >= -2.0 && $nilai <= 2.0) {
                    $result = 'Normal';
                } else {
                    $result = 'Gemuk';
                }
                break;

            // Tambahkan kondisi untuk jenis lain seperti lingkarKepala, imt, dll.
            default:
                $result = 'Indikator tidak valid';
        }

        return $result;
    }
}
