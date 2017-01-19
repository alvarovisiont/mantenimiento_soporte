<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{
    protected $table='usuario';

    protected $primaryKey='id_user';

    public $timestamp=false;

    protected $fillable = [
    'id_tarea',
    'nombre',
    'apellido',
    'usuario',
    'pass',
    'nivel',
    'acivo',
    'fecha_reg'];

    protected $guarded = [];
}
