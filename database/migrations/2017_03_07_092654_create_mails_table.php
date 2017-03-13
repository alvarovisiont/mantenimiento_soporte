<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mails', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('soporte_id')->unsigned();
            $table->integer('trabajadores_id')->unsigned();
            $table->text('subject',100);
            $table->text('message',1000);
            $table->integer('sent_by');
            $table->integer('status');
            $table->text('files');
            $table->integer('eliminado');
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
        Schema::drop('mails');
    }
}
