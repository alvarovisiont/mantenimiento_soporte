<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActualizacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actualizaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('equipos_id')->unsigned();
            $table->integer('soportes_id')->unsigned();
            $table->string('descripcion');
            $table->foreign('equipos_id')->references('id')->on('equipos');
            $table->foreign('soportes_id')->references('id')->on('soportes');
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
        Schema::drop('actualizaciones');
    }
}
