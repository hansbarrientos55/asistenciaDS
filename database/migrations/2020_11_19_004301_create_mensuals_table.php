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
            $table->bigIncrements('id')->generatedAs('start with 125 increment by 1');
            $table->integer('user_id')->unsigned();
            $table->string('fecha')->nullable();
            $table->string('hora')->nullable();
            $table->string('mes');
            $table->string('vistobueno');
            $table->string('firma');
            $table->double('horas', 5 ,1);
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
