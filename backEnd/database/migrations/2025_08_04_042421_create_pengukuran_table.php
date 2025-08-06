<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pengukuran', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idBalita');
            $table->date('tglPengukuran');
            $table->float('berat');
            $table->float('tinggi');
            $table->float('suhu');
            $table->float('lingkar_kepala');
            $table->float('IMT');
            $table->timestamps();
            $table->foreign('idBalita')->references('id')->on('balita')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kunjungan');
    }
};
