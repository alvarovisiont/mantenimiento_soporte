<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;

class Trabajadores extends Model
{
    //
    protected $fillable = ['nombre_completo', 'cedula', 'telefono', 'email', 'departamento_id', 'equipos_id'];

    protected $guarded = ['id'];

    public function traer_trabajadores()
    {
    	return $this->select('id', 'nombre_completo')->pluck('nombre_completo', 'id')->toArray();
    }

    public function traer_trabajadores_respuesta($id)
    {
        return $this->select('id', 'nombre_completo')->where('id', '=', $id)->pluck('nombre_completo', 'id')->toArray();   
    }
    public function nombre_trabajador($id)
    {
    	$datos = $this->select('nombre_completo')->where('id', '=',$id)->get();
    	return $datos[0]['nombre_completo'];
    }

    public function online_offline($id)
    {
        $dato = User::select('online')->where([
            ['trabajadores_id', '=', $id],
            ['nivel', '<>', 2]
        ])->get();
        return $dato[0]['online'];
    }
}
