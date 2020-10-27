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
            $table->increments('id')->generatedAs('start with 50 increment by 1');
            $table->string('codigomate');
            $table->string('nombremate');
            $table->string('descripcionmate');
            $table->string('nivelmate');
            $table->boolean('estaactivo');
            $table->unsignedInteger('departamento_id')->default('0'); // Relación con categorias
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
