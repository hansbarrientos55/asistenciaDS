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
            $table->bigIncrements('id');
            $table->string('fecha');
            $table->string('hora');
            $table->string('motivo');
            $table->string('fechaausencia');
            $table->string('horaausencia');
            $table->string('estaaceptada')->default('Esperando confirmacion');
            $table->string('label')->nullable();
            $table->timestamps();
        });

        Schema::create('ausencias_users', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('ausencia_id');
            $table->timestamps();

            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('ausencia_id')
            ->references('id')
            ->on('ausencias')
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
