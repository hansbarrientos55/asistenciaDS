<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarrerasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carreras', function (Blueprint $table) {
            $table->increments('id')->generatedAs('start with 175 increment by 1');
            $table->string('codigocarrera')->unique();
            $table->string('nombrecarrera')->unique();
            $table->string('descripcioncarrera')->unique();
            $table->string('estaactivo')->default('Activo');
            $table->unsignedInteger('facultad_id')->default('0');
            $table->string('facultad_nombre')->nullable();
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
        Schema::dropIfExists('carreras');
    }
}
