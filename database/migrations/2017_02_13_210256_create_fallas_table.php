<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFallasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fallas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('equipos_id')->unsigned();
            $table->integer('trabajador_id')->unsigned();
            $table->integer('departamento_id')->unsigned();
            $table->string('descripcion');
            $table->integer('status');
            $table->integer('soporte_id')->nullable();
            $table->foreign('equipos_id')->references('id')->on('equipos');
            $table->foreign('trabajador_id')->references('id')->on('trabajadores');
            $table->foreign('departamento_id')->references('id')->on('departamentos');
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
        Schema::drop('fallas');
    }
}
