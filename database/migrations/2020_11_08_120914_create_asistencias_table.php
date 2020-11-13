<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsistenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asistencias', function (Blueprint $table) {
            $table->increments('id')->generatedAs('start with 50 increment by 1');
            $table->string('tipo')->nullable();
            $table->string('fecha')->nullable();
            $table->string('hora')->nullable();
            $table->string('mes')->nullable();
            $table->string('iniciosemana')->nullable();
            $table->string('finsemana')->nullable();
            $table->string('grupo')->nullable();
            $table->string('materia')->nullable();
            $table->string('contenido')->nullable();
            $table->string('plataforma')->nullable();
            $table->string('observaciones')->nullable();
            $table->string('firma')->nullable();
            //$table->file('archivo')->nullable();//Archivo
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
        Schema::dropIfExists('asistencias');
    }
}
