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
            $table->bigIncrements('id');
            $table->string('fecha');
            $table->string('hora');
            $table->integer('ausencia_id')->unsigned();
            $table->string('grupo');
            $table->string('materia');
            $table->string('contenido');
            $table->string('plataforma');
            $table->string('observaciones');
            $table->string('label')->nullable();
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
