<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTareasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tareas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('trabajadores_id')->unsigned();
            $table->integer('soporte_id')->unsigned();
            $table->integer('equipo_id')->unsigned();
            $table->string('descripcion');
            $table->string('fecha_tarea');
            $table->string('tipo');
            $table->foreign('equipo_id')->references('id')->on('equipos');
            $table->foreign('trabajadores_id')->references('id')->on('trabajadores');
            $table->foreign('soporte_id')->references('id')->on('soportes');
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
        Schema::drop('tareas');
    }
}
