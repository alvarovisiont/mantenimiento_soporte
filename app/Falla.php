<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;

class Falla extends Model
{
    //
    protected $fillable = ['equipos_id', 'trabajador_id', 'departamento_id', 'descripcion', 'status'];

    public function trabajadores()
    {
    	return $this->join('trabajadores', 'trabajadores.id', '=', 'fallas.trabajador_id')
    				->select('trabajadores.id', 'trabajadores.nombre_completo')
    				->pluck('trabajadores.nombre_completo', 'trabajadores.id')
    				->toArray();
    }

    public function equipos()
    {	
    	return $this->join('equipos', 'equipos.id', '=', 'fallas.equipos_id')
    				->select('equipos.id', 'equipos.nom_equipo', 'equipos.bm')
    				->pluck('equipos.nom_equipo', 'equipos.id')
    				->toArray();
    }
    
    public function departamentos()
    {	
    	return $this->join('departamentos', 'departamentos.id', '=', 'fallas.departamento_id')
    				->select('departamentos.id', 'departamentos.nombre')
    				->pluck('departamentos.nombre', 'departamentos.id')
    				->toArray();
    }

    public function datos_reporte()
    {
    	return $this->join('departamentos', 'departamentos.id', '=', 'fallas.departamento_id')
    				->join('equipos', 'equipos.id', '=', 'fallas.equipos_id')
    				->join('trabajadores', 'trabajadores.id', '=', 'fallas.trabajador_id')
    				->select('fallas.descripcion','fallas.status', 'fallas.created_at', 'departamentos.nombre as departamento', 'equipos.nom_equipo', 'equipos.bm', 'trabajadores.nombre_completo as trabajador')
    				->get();
    }

    public function traer_fallas()
    {
        if(Auth::user()->nivel != 3)
        {
            return $this->join('equipos', 'equipos.id', '=', 'fallas.equipos_id')
                            ->join('trabajadores', 'trabajadores.id', '=', 'fallas.trabajador_id')
                            ->select('fallas.*', 'trabajadores.nombre_completo', 'equipos.bm')
                            ->orderBy('created_at', 'desc')
                            ->get();
        }
        else
        {
            return $this->join('equipos', 'equipos.id', '=', 'fallas.equipos_id')
                            ->join('trabajadores', 'trabajadores.id', '=', 'fallas.trabajador_id')
                            ->select('fallas.*', 'trabajadores.nombre_completo', 'equipos.bm')
                            ->where('trabajadores.id', '=' , Auth::user()->trabajadores_id)
                            ->orderBy('created_at', 'desc')
                            ->get();
        }
    }

}
