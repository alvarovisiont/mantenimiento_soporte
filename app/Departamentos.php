<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departamentos extends Model
{
 	protected $table = "departamentos";

 	protected $primaryKey = "id_departamento";

 	public $timestamp = false;

 	protected $fillable = [
        'id_departamento',
        'nombre', 
        'descripcion'
    ];

    protected $guarded = [];
}

