<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actualizaciones extends Model
{

    protected $fillable = [
    'equipos_id',
    'soportes_id',
    'descripcion'];
}
