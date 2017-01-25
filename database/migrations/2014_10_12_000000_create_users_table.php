<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id_user');
<<<<<<< HEAD
            $table->integer('cedula');
=======
            $table->string('cedula');
>>>>>>> 763d128ee1afa0ee51914744f4a597bffd714e99
            $table->string('name',120);
            $table->string('apellido',155);
            $table->string('usuario')->unique();
            $table->string('password',70);
            $table->string('nivel',1);
            $table->rememberToken();
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

        Schema::drop('users');
    }
}
