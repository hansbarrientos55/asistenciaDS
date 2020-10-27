<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id')->generatedAs('start with 50 increment by 1');
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('cedula');
            $table->string('fechanacimiento');
            $table->string('direccion');
            $table->string('profesion');
            $table->string('username')->unique();
            $table->string('contrasenia');
            $table->string('password');
            $table->string('emailprincipal');
            $table->string('emailsecundario');
            $table->string('telefonoprincipal');
            $table->string('telefonosecundario');
            $table->boolean('estaactivo')->default(1);
            $table->string('rolprimario');
            $table->string('rolsecundario');
            $table->string('rolprimariotexto');
            $table->string('rolsecundariotexto');
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
        Schema::dropIfExists('users');
    }
}
