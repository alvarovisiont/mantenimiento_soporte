<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSoportesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('soportes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre_completo');
            $table->integer('cedula');
            $table->integer('tareas_id')->unsigned();
            $table->integer('actualizaciones_id')->unsigned();
            $table->foreign('tareas_id')->references('id')->on('tareas');
            $table->foreign('actualizaciones_id')->references('id')->on('actualizaciones');
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
        Schema::drop('soportes');
    }
}
