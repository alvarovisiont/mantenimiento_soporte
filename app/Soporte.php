<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Soporte extends Model
{
    protected $fillable= [
    'cedula',
    'nombre_completo'];

    public function traer_soportes()
    {
    	return $this->select('nombre_completo', 'id')->pluck('nombre_completo', 'id')->toArray();
    }

    public function traer_soportes_respuesta($id)
    {
        return $this->select('nombre_completo', 'id')->where('id', '=', $id)->pluck('nombre_completo', 'id')->toArray();   
    }

    public function nombre_soporte($id)
    {
    	$datos = $this->select('nombre_completo')->where('id','=',$id)->get();

    	return  $datos[0]['nombre_completo'];

    }

    public function online_offline($id)
    {
        $dato = User::select('online')->where([
            ['trabajadores_id', '=', $id],
            ['nivel', '=', 2]
        ])->get();
        return $dato[0]['online'];
    }
}
