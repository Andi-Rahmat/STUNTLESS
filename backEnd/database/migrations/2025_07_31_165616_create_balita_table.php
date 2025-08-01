<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBalitaTable extends Migration
{
    /**
     * Jalankan migrasi untuk membuat tabel.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('balita', function (Blueprint $table) {
            $table->id(); // Menambahkan kolom id sebagai primary key
            $table->string('namaLengkap'); // Kolom untuk nama lengkap
            $table->string('nik')->unique(); // Kolom untuk NIK, dengan constraint unique
            $table->date('tglLahir'); // Kolom untuk tanggal lahir
            $table->integer('anak_ke'); // Kolom untuk anak ke-
            $table->string('golongan_darah', 3); // Kolom untuk golongan darah (misal: A, B, AB, O)
            $table->foreignId('idOrangTua')->constrained('orang_tua')->onDelete('cascade'); // Relasi dengan tabel orang_tua, dengan foreign key

            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Balikkan perubahan yang dilakukan oleh migrasi.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('balita');
    }
}
