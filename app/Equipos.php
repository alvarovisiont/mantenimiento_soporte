<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipos extends Model
{
    //

    public function traer_usuarios($numero)
    {
    	return $this->hasOne('App\User');
    }
}
