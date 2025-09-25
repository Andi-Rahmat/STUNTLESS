<?php

use App\Models\Pengukuran;
use App\Models\User;
use Carbon\Carbon;
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

if (!function_exists('notif')) {
    function notif()
    {
        $idBalitas = userOrangTua()->balita->pluck('id');
        $pengukurans = Pengukuran::whereIn('idBalita', $idBalitas)
        ->orderBy('idBalita')  // Mengurutkan berdasarkan idBalita (opsional, hanya untuk pengelompokkan)
        ->orderBy('tglPengukuran', 'desc')
        ->get()
        ->groupBy('idBalita');  // Mengelompokkan berdasarkan idBalita

        $i = 0;
        $reminder = [];
        $warning = [];

        foreach ($pengukurans as $pengukuran) {
            $pengukuranTerbaru = $pengukuran->first();
            $pengukuranSebelumnya = $pengukuran->skip(1)->first() ?? null;
            $tanggalPengukuran = Carbon::parse(($pengukuranTerbaru)->tglPengukuran);
            $tanggalSekarang = Carbon::now();
            $selisihBulan = $tanggalPengukuran->diffInMonths($tanggalSekarang);
            $selisihBulanWarning = Carbon::parse(($pengukuranSebelumnya)->tglPengukuran)->diffInMonths(Carbon::parse(($pengukuranTerbaru)->tglPengukuran));
            if($pengukuranTerbaru->zScore->tinggi <= -2 && $pengukuranSebelumnya->zScore->tinggi <= -2 && $selisihBulanWarning >= 1 ){
                $warning[$i] = $pengukuranTerbaru;
            }
            if ($selisihBulan >= 1) {
                $reminder[$i] = $pengukuranTerbaru;
            }
            $i++;
        }
        $jumlahNotif = count($reminder) + count($warning);
        $dataNotif = [
            'reminder'  => $reminder,
            'warning'   => $warning,
            'jumlahN'   => $jumlahNotif
        ];
        
        return $dataNotif;

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
        $user = User::find(Auth::user()->id)->orangTua;

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

        $prevKey = null;
        $prevValue = null;

        foreach ($sdData as $key => $value) {
            if ($nilai <= $value) {
                if ($prevKey !== null) {
                    $kategori = $prevKey;
                } else {
                    $kategori = $key; // Jika nilai lebih kecil dari batas pertama
                }
                break;
            }
            $prevKey = $key;
            $prevValue = $value;
        }

        // Jika nilai lebih besar dari semua batas
        if (!isset($kategori)) {
            $kategori = array_key_last($sdData);
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
                    return 'Berat badan sangat kurang';
                } elseif ($nilai < -2.0) {
                    return 'Berat badan kurang';
                } elseif ($nilai <= 1.0) {
                    return 'Berat badan normal';
                } else {
                    return 'Risiko berat badan lebih';
                }
                break;

            case 'tinggi':
                if ($nilai < -3.0) {
                    return 'Sangat pendek';
                } elseif ($nilai < -2.0) {
                    return 'Pendek';
                } elseif ($nilai <= 3.0) {
                    return 'Normal';
                } else {
                    return 'Tinggi';
                }
                break;

            case 'berat/tinggi':
                if ($nilai < -3.0) {
                    return 'Gizi buruk';
                } elseif ($nilai < -2.0) {
                    return 'Gizi kurang';
                } elseif ($nilai <= 1.0) {
                    return 'Gizi baik';
                } elseif ($nilai <= 2.0) {
                    return 'Berisiko gizi lebih';
                } elseif ($nilai <= 3.0) {
                    return 'Gizi lebih';
                } else {
                    return 'Obesitas';
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
                    return 'Gizi buruk';
                } elseif ($nilai < -2.0) {
                    return 'Gizi kurang';
                } elseif ($nilai <= 1.0) {
                    return 'Gizi baik';
                } elseif ($nilai <= 2.0) {
                    return 'Berisiko gizi lebih';
                } elseif ($nilai <= 3.0) {
                    return 'Gizi lebih';
                } else {
                    return 'Obesitas';
                }
                break;
            // Tambahkan kondisi untuk jenis lain seperti lingkarKepala, imt, dll.
            default:
                $result = 'Indikator tidak valid';
        }

        return $result;
    }
}

if (!function_exists('getInterpretasi')) {
    /**
     * Fungsi untuk memilih kategori interpretasi berdasarkan nilai Z-score
     * @param string $indikator (misalnya: "berat", "tinggi", "berat/tinggi", "imt", "lingkarKepala")
     * @param float $zscore nilai Z-score hasil perhitungan
     * @return array interpretasi sesuai kategori
    */
    function getInterpretasi($indikator, $zscore)
    {
        $dataInterpretasi = require app_path('data/interpretasi.php');
        if (!isset($dataInterpretasi[$indikator])) {
            return [
                "status" => "Tidak ditemukan",
                "interpretasi" => "Indikator tidak tersedia.",
                "saran" => []
            ];
        }

        foreach ($dataInterpretasi[$indikator] as $kategori) {
            $range = $kategori["range_z"];

            // Parsing range manual
            if (strpos($range, "<") !== false && strpos($range, "-") === false && $zscore < -3 && $range == "Z < -3") {
                return $kategori;
            }
            if ($range == "-3 ≤ Z < -2" && $zscore >= -3 && $zscore < -2) {
                return $kategori;
            }
            if ($range == "-2 ≤ Z ≤ +1" && $zscore >= -2 && $zscore <= 1) {
                return $kategori;
            }
            if ($range == "Z > +1" && $zscore > 1) {
                return $kategori;
            }

            // Untuk TB/U
            if ($range == "-2 ≤ Z ≤ +3" && $zscore >= -2 && $zscore <= 3) {
                return $kategori;
            }
            if ($range == "Z > +3" && $zscore > 3) {
                return $kategori;
            }

            // Untuk WHZ & BAZ detail
            if ($range == "Z < -3" && $zscore < -3) {
                return $kategori;
            }
            if ($range == "-3 ≤ Z < -2" && $zscore >= -3 && $zscore < -2) {
                return $kategori;
            }
            if ($range == "-2 ≤ Z ≤ +1" && $zscore >= -2 && $zscore <= 1) {
                return $kategori;
            }
            if ($range == "+1 < Z ≤ +2" && $zscore > 1 && $zscore <= 2) {
                return $kategori;
            }
            if ($range == "+2 < Z ≤ +3" && $zscore > 2 && $zscore <= 3) {
                return $kategori;
            }
            if ($range == "Z > +3" && $zscore > 3) {
                return $kategori;
            }

            // Untuk LK/U
            if ($range == "-2 ≤ Z ≤ +2" && $zscore >= -2 && $zscore <= 2) {
                return $kategori;
            }
        }

        // Jika tidak cocok
        return [
            "status" => "Tidak terklasifikasi",
            "interpretasi" => "Nilai Z-score tidak masuk dalam kategori standar.",
            "saran" => []
        ];
    }
}
