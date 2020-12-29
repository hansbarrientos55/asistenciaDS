<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsignacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asignacions', function (Blueprint $table) {
            $table->increments('id')->generatedAs('start with 100 increment by 1');
            $table->string('gestion');
            $table->string('departamento');
            $table->integer('docente')->unsigned();
            $table->string('nomdocente')->nullable();
            $table->string('materia');
            $table->string('nommateria')->nullable();
            $table->string('grupo');
            $table->timestamps();

            $table->foreign('docente')->references('id')->on('users')
            ->onDelete('set null')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asignacions');
    }
}
