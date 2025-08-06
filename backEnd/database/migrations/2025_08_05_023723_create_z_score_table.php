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
        Schema::create('z_score', function (Blueprint $table) {
            $table->id();
            $table->float('berat');
            $table->string('beratSd');
            $table->float('tinggi');
            $table->string('tinggiSd');
            $table->float('beratTinggi');
            $table->string('beratTinggiSd');
            $table->float('lingkar_kepala');
            $table->string('lingkar_kepalaSd');
            $table->float('imt');
            $table->string('imtSd');
            $table->unsignedBigInteger('idPengukuran');
            $table->foreign('idPengukuran')->references('id')->on('pengukuran')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('z_score');
    }
};
