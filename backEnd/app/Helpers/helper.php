<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;

if (!function_exists('hitungUsia')) {
    /**
     * Fungsi untuk menghitung usia berdasarkan tanggal lahir
     *
     * @param string $birthdate Tanggal lahir dalam format 'Y-m-d'
     * @return int Usia
     */
    function hitungUsia($birthdate, $b = null)
    {
        $birthDate = new \DateTime($birthdate);
        $today = $b != null ? new \DateTime($b) : new \DateTime($b);
        $age = $today->diff($birthDate);

        return $age->y . ' tahun ' . $age->m . ' bulan';
    }
}
if (!function_exists('hitungUsiaBulan')) {
    /**
     * Fungsi untuk menghitung usia berdasarkan tanggal lahir
     *
     * @param string $birthdate Tanggal lahir dalam format 'Y-m-d'
     * @return int Usia
     */
    function hitungUsiaBulan($birthdate, $b = null)
    {
        $birthDate = new \DateTime($birthdate);
        $today = $b != null ? new \DateTime($b) : new \DateTime($b);
        $age = $today->diff($birthDate);

        return $age->m + ($age->y * 12);
    }
}

if (!function_exists('userOrangTua')) {
    /**
     * mengambbil data user yang sedang login
     *
     * @param string $birthdate Tanggal lahir dalam format 'Y-m-d'
     * @return int Usia
     */
    function userOrangTua()
    {
        $user = User::find(Auth::user()->id);

        return  $user;
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

if (!function_exists('checkKelamin')) {
    /**
     * Fungsi untuk menghitung usia berdasarkan tanggal lahir
     *
     * @param string $birthdate Tanggal lahir dalam format 'Y-m-d'
     * @return int Usia
     */
    function checkKelamin($kelamin)
    {
        if ($kelamin == 'L') {
            return 'laki-laki';
        } else {
            return 'perempuan';
        }
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
                }else {
                    $result = 'Sangat Tinggi';
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

            case 'lingkarKepala':
                if ($nilai < -2.0) {
                    $result = 'Mikrosefali';
                } elseif ($nilai >= -2.0 && $nilai <= 2.0) {
                    $result = 'Normal';
                } else {
                    $result = 'Makrosefali';
                }
                break;

            case 'imt':
                if ($nilai < -3.0) {
                    $result = 'Gizi buruk';
                } elseif ($nilai >= -3.0 && $nilai <= -2.0) {
                    $result = 'Gizi kurang';
                } elseif ($nilai > -2.0 && $nilai <= 1.0) {
                    $result = 'Gizi baik (normal)';
                } elseif ($nilai > 1.0 && $nilai <= 2.0) {
                    $result = 'Gizi lebih';
                } elseif ($nilai > 2.0 && $nilai <= 3.0) {
                    $result = 'Gizi lebih (risiko)';
                } else {
                    $result = 'Obesitas';
                }
                break; 
            // Tambahkan kondisi untuk jenis lain seperti lingkarKepala, imt, dll.
            default:
                $result = 'Indikator tidak valid';
        }

        return $result;
    }
}
