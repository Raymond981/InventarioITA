<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMantenimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mantenimientos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tipo_mantenimiento');
            $table->string('responsable');
            $table->time('fecha_inicio');
            $table->time('fecha_fin');
            $table->string('1_1');
            $table->string('1_2');
            $table->string('1_3');
            $table->string('2_1');
            $table->string('2_2');
            $table->string('2_3');
            $table->string('2_4');
            $table->string('3_1');
            $table->string('3_2');
            $table->string('4_1');
            $table->string('4_2');
            $table->string('5_1');
            $table->string('5_2');
            $table->string('refaccion_piezas');
            $table->string('observaciones');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mantenimientos');
    }
}
