<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Departamentos extends Model
{
    //
    protected $fillable = ['nombre', 'descripcion'];

// =============================== FUNCIONES PARA LOS REPORTES DE LOS DEPARTAMENTOS ===========================

    public function departamentos()
    {
    	return $this->select('id', 'nombre')->pluck('nombre', 'id')->toArray();
    }

// =============================== FUNCIÓN PARA RETORNAR DATOS DEL REPORTE ====================================

    public function datos_reporte($where)
    {
    	return $this->join('trabajadores', 'trabajadores.departamento_id', '=', 'departamentos.id')
    				->join('equipos', 'equipos.id', '=', 'trabajadores.equipos_id')
    				->leftJoin('characteristic_computers', 'characteristic_computers.id', '=', 'equipos.tipo')
    				->select('departamentos.nombre as departamento', 'trabajadores.nombre_completo as trabajador', 'equipos.*', 'characteristic_computers.tipo as caracteristicas')
    				->whereRaw($where)
    				->get();
    }
}
