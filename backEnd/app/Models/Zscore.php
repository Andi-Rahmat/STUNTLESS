<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZScore extends Model
{
    use HasFactory;

    // Nama tabel yang digunakan oleh model ini
    protected $table = 'z_score'; // Nama tabel di database
    public $timestamps = false;


    // Kolom yang bisa diisi secara massal (mass assignable)
    protected $fillable = [
        'beratSd',
        'berat',
        'tinggiSd',
        'tinggi',
        'beratTinggiSd',
        'beratTinggi',
        'lingkar_kepalaSd',
        'lingkar_kepala',
        'imtSd',
        'imt',
        'idPengukuran'
    ];

    // Relasi dengan model Pengukuran
    public function pengukuran()
    {
        return $this->belongsTo(Pengukuran::class, 'idPengukuran');
    }

    // Jika tabel ini tidak menggunakan kolom created_at dan updated_at, tambahkan ini:
    // public $timestamps = false;
}
