<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataIotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_iot', function (Blueprint $table) {
            $table->id();
            $table->float('berat');  // Field for berat (weight)
            $table->float('tinggi'); // Field for tinggi (height)
            $table->float('suhu');  // Field for suhu (temperature)
            $table->float('lingkar_kepala');  // Field for lingkar_kepala (head circumference)
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_iot');
    }
}
