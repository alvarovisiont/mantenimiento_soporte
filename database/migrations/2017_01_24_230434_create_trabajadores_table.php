<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrabajadoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trabajadores', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('equipos_id')->unsigned();
            $table->string('nombre_completo');
            $table->integer('cedula');
            $table->string('telefono', 15);
            $table->integer('departamento_id')->unsigned();
            $table->string('email', 50);
            $table->foreign('departamento_id')->references('id')->on('departamentos');
            $table->foreign('equipos_id')->references('id')->on('equipos');
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
        Schema::drop('trabajadores');
    }
}
