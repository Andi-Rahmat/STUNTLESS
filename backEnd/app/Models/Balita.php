<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Balita extends Model
{
    protected $table = 'balita';
    public $timestamps = false;
    use HasFactory;

    // Menentukan kolom-kolom yang dapat diisi massal (fillable)
    protected $fillable = [
        'namaLengkap',
        'NIK',
        'tglLahir',
        'jenisKelamin',
        'anak_ke',
        'golongan_darah',
        'idOrangTua',
    ];

    public function orangTua()
    {
        return $this->belongsTo(OrangTua::class, 'idOrangTua');
    }
    public function pengukuran()
    {
        return $this->hasMany(Pengukuran::class, 'idBalita','id');
    }
}
