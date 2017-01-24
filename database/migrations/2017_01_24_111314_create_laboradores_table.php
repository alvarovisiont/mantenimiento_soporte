<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLaboradoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laboradores', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tareas_id')->lenght(10)->unsigned();
            $table->integer('equipo_id')->unsigned();
            $table->string('nombre_completo');
            $table->integer('cedula');
            $table->string('telefono', 15);
            $table->integer('departamento_id')->lenght(10)->unsigned();
            $table->string('email', 50);
            $table->foreign('departamento_id')->references('id_departamento')->on('departamentos');
            $table->foreign('tareas_id')->references('id')->on('tareas');
            $table->foreign('equipo_id')->references('id')->on('equipos');
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
        Schema::drop('laboradores');
    }
}
