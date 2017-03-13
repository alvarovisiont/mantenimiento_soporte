<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEquiposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('bm');
            $table->string('nom_equipo', 50);
            $table->string('ip', 30);
            $table->string('monitor', 50);
            $table->string('descripcion_monitor', 1000);
            $table->string('raton', 50);
            $table->string('descripcion_raton', 1000);
            $table->string('teclado', 50);
            $table->string('descripcion_teclado', 1000);
            $table->string('tipo');
            $table->string('caracteristicas_extras');
            $table->string('color');
            $table->integer('status');
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
        Schema::drop('equipos');
    }
}
