<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LingkarKepala extends Model
{
    use HasFactory;

    // Menentukan nama tabel yang digunakan (jika berbeda dengan nama model)
    protected $table = 'data_lingkar_kepala';

    protected $fillable = [
        'lingkarKepala',
    ];

    // Jika Anda menggunakan timestamps secara manual, Anda bisa menonaktifkannya
    public $timestamps = true;
}
