<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengukuran extends Model
{
    use HasFactory;

    // Nama tabel yang terkait dengan model ini
    protected $table = 'pengukuran'; // Sesuaikan dengan nama tabel yang kamu gunakan

    // Kolom yang bisa diisi massal
    protected $fillable = [
        'idBalita', 
        'tglPengukuran', 
        'berat', 
        'tinggi', 
        'suhu', 
        'lingkar_kepala', 
        'IMT',
    ];

    public $timestamps = true;

    public function balita()
    {
        return $this->belongsTo(Balita::class, 'idBalita','idBalita');
    }
}
