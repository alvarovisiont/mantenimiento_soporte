<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tareas extends Model
{
    protected $table = "tareas";

    protected $primaryKey = "id_tarea";

    public $timestamp = false;

    protected $fillable = [
    						'id_tarea', 'mensaje', 'foto_tarea', 'usuario_id', 'departamento_id', 'fecha_reg_tarea'
    					];

    protected $guarded = [];

}
