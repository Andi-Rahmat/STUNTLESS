<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrangTua extends Model
{
    use HasFactory;

    protected $table = 'orang_tua';
    public $timestamps = false;

    protected $fillable = [
        'namaLengkap',
        'tglLahir',
        'alamat',
        'jenisKelamin',
        'jumlahAnak',
        'nik',
        'idUser', 
    ];

    // Relasi dengan model User (1 ke 1)
    public function user()
    {
        return $this->belongsTo(User::class,'idUser');
    }
}
