<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReposicionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reposicions', function (Blueprint $table) {
            $table->bigIncrements('id')->generatedAs('start with 175 increment by 1');
            $table->integer('ausencia_id')->unsigned();
            $table->string('fecha');
            $table->string('hora');
            $table->string('nuevafecha');
            $table->string('horario')->nullable();
            $table->string('grupo')->nullable();
            $table->string('materia')->nullable();
            $table->string('contenido')->nullable();
            $table->string('plataforma')->nullable();
            $table->string('observaciones')->nullable();
            $table->string('estado');
            $table->string('label')->nullable();
            $table->string('grabacion')->nullable();
            $table->string('tarea')->nullable();
            $table->timestamps();

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
        Schema::dropIfExists('reposicions');
    }
}
