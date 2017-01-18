<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipos extends Model
{
    protected $table = 'equipos';

    protected $primaryKey = 'id_equipo'

    public $timestamp=false;

    protected $fillable= [
    'bien_mueble',
    'id_trabajador',
    'ip_equipo',
    'capacidad',
    'fallas',
    'reporte',
    'actualizacion',
    'status',
    'fecha_reg_equipos'];

    protected $guarded=[];
}
