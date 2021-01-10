<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAusenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ausencias', function (Blueprint $table) {
            $table->bigIncrements('id')->generatedAs('start with 125 increment by 1');
            $table->integer('user_id')->unsigned();
            $table->string('fecha');
            $table->string('hora');
            $table->string('motivo');
            $table->string('fechaausencia');
            $table->string('horaausencia');
            $table->string('estaaceptada')->default('Esperando confirmacion');
            $table->string('archivo')->nullable();
            $table->string('label')->nullable();
            $table->timestamps();

            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade')
            ->onUpdate('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ausencias');
    }
}
