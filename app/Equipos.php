<?php

namespace App;

use Illuminate\Database\Eloquent\Model;



class Equipos extends Model
{
    //
    protected $fillable = ['bm', 'nom_equipo', 'ip',  'monitor','descripcion_monitor','raton','descripcion_raton','teclado','descripcion_teclado','tipo','caracteristicas_extras', 'color', 'status'];


//======================== QUERYS PARA LOS SELECTS DEL REPORTE ==========================================

    public function bm_equipos()
    {
    	return $this->select('bm')->pluck('bm', 'bm')->toArray();
    }

    public function nombre_equipos()
    {
    	return $this->select('nom_equipo')->pluck('nom_equipo', 'nom_equipo')->toArray();	
    }

    public function bm_monitor()
    {
    	return $this->select('monitor')->pluck('monitor', 'monitor')->toArray();		
    }

    public function bm_raton()
    {
    	return $this->select('raton')->pluck('raton', 'raton')->toArray();		
    }

    public function bm_teclado()
    {
    	return $this->select('teclado')->pluck('teclado', 'teclado')->toArray();		
    }
// ================================================================================================================

//=============================== FUNCIÓN PARA EL QUERY DEL PDF ===========================================

    public function datos_pdf($where)
    {

        return $this->select('*', 'characteristic_computers.tipo as caracteristicas')
                    ->leftJoin('characteristic_computers', 'characteristic_computers.id', '=', 'equipos.tipo')
                    ->whereRaw($where)
                    ->get();        
    }     

//**************************************************************************************************************

// ========================= Contar los equipos ================================================================

    public function count_equipos()
    {
        return $this->count();
    }
//**************************************************************************************************************

}
