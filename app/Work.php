<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    //
    protected $fillable = ['falla_id', 'trabajadores_id', 'soporte_id', 'equipo_id', 'descripcion', 'fecha_tarea', 'status'];
}
