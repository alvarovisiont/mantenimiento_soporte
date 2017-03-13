<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('works', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('falla_id')->unsigned();
            $table->integer('trabajadores_id');
            $table->integer('soporte_id')->unsigned();
            $table->integer('equipo_id');
            $table->string('descripcion');
            $table->string('fecha_tarea');
            $table->integer('status');
            $table->foreign('falla_id')->references('id')->on('fallas');
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
        Schema::drop('works');
    }
}
