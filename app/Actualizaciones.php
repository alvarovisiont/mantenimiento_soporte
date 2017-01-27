<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actualizaciones extends Model
{
    protected $table = 'actualizaciones';

    protected $fillable = [
    'equipos_id',
    'soportes_id',
    'descripccion'];
}
