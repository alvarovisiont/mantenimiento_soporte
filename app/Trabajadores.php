<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trabajadores extends Model
{
    //
    protected $fillable = ['equipos_id, nombre_completo, cedula, telefono, departamento_id, email'];
}
