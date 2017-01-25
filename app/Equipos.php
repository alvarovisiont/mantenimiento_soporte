<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipos extends Model
{
    //
    protected $fillable = ['bm', 'nom_equipo', 'ip', 'descripcion'];

    public function traer_usuarios($numero)
    {
    	return $this->hasOne('App\User');
    }
}
