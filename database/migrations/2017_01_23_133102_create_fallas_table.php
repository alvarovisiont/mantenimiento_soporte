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
            $table->integer('equipo_id')->unsigned();
            $table->string('descripcion');
            $table->integer('status')->unsigned();
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
        Schema::drop('fallas');
    }
}
