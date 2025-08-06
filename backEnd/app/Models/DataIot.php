<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataIot extends Model
{
    use HasFactory;

    // Menentukan nama tabel yang digunakan (jika berbeda dengan nama model)
    protected $table = 'data_iot';

    // Menentukan kolom yang dapat diisi secara massal (fillable)
    protected $fillable = [
        'berat',
        'tinggi',
        'suhu',
        'lingkar_kepala',
    ];

    // Jika Anda menggunakan timestamps secara manual, Anda bisa menonaktifkannya
    public $timestamps = true;
}
