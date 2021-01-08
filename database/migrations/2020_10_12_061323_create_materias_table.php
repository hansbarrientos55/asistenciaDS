<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMateriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materias', function (Blueprint $table) {
            $table->increments('id')->generatedAs('start with 75 increment by 1');
            $table->string('codigomate')->unique();
            $table->string('nombremate')->unique();
            $table->string('descripcionmate')->unique();
            $table->string('nivelmate');
            $table->string('estaactivo')->default('Activo');
            $table->unsignedInteger('departamento_id')->default('0'); // Relación con categorias
            $table->string('departamento_nombre')->nullable();
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
        Schema::dropIfExists('materias');
    }
}
