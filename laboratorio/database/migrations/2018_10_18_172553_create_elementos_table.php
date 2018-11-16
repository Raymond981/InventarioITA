<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateElementosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('elementos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tipo',10)->nullable();
            $table->string('nombre',100)->nullable();
            $table->string('descripcion',150)->nullable();
            $table->float('clase')->nullable();
            $table->string('estado_fisico',20)->nullable();
            $table->string('formula_quimica',150)->nullable();
            $table->string('no_serie', 100)->nullable();
            $table->integer('no_piezas')->nullable();
            $table->float('cantidad')->nullable();
            $table->string('unidad_medida',10)->nullable();
            $table->dateTime('mantenimiento1')->nullable();
            $table->dateTime('mantenimiento2')->nullable();
            $table->boolean('eliminado')->default(0);
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
        Schema::dropIfExists('elementos');
    }
}
