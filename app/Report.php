<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    //

    protected $fillable = ['falla_id','soporte_id','trabajador_id','cuerpo_reporte','imagenes'];
}
