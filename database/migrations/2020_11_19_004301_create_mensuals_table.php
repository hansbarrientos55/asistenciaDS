<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMensualsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mensuals', function (Blueprint $table) {
            $table->bigIncrements('id')->generatedAs('start with 200 increment by 1');
            $table->string('fecha')->nullable();
            $table->string('hora')->nullable();
            $table->string('mes')->nullable();
            $table->integer('user_id')->unsigned();
            $table->string('usuario')->nullable();
            $table->double('horas', 5 ,1)->nullable();
            $table->double('asistidas', 5 ,1)->nullable();
            $table->double('faltas', 5 ,1)->nullable();
            $table->double('licencia', 5 ,1)->nullable();
            $table->double('baja', 5 ,1)->nullable();
            $table->double('comision', 5 ,1)->nullable();
            $table->double('totalpagables', 5 ,1)->nullable();
            $table->string('vistobueno')->nullable();
            $table->string('firma')->nullable();
            $table->string('archivo')->nullable();
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
        Schema::dropIfExists('mensuals');
    }
}
