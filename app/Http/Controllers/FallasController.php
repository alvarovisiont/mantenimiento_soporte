<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

use App\Http\Requests;

use App\Falla;

use App\Soporte;

use App\Work;

use App\Report;

use App\Trabajadores;



class FallasController extends Controller
{

    public function __Construct()
    {
        $this->middleware('validate.user');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if(Auth::user()->nivel == 1)
        {
            $datos = Falla::join('equipos', 'equipos.id', '=', 'fallas.equipos_id')
                            ->join('trabajadores', 'trabajadores.id', '=', 'fallas.trabajador_id')
                            ->select('fallas.*', 'trabajadores.nombre_completo', 'equipos.bm')
                            ->get();
                            
            return view('fallas.administracion', ['datos' => $datos]);
        }
        elseif(Auth::user()->nivel == 3)
        {
            $datos = Falla::join('equipos', 'equipos.id', '=', 'fallas.equipos_id')
                            ->join('trabajadores', 'trabajadores.id', '=', 'fallas.trabajador_id')
                            ->select('fallas.*', 'trabajadores.nombre_completo', 'equipos.bm')
                            ->where('trabajadores.id', '=' , Auth::user()->trabajadores_id)
                            ->get();
            return view('fallas.fallas_reportadas_trabajadores', ['datos' => $datos]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
            $query =    Trabajadores::join('equipos', 'equipos.id', '=', 'trabajadores.equipos_id')
                                ->join('departamentos', 'departamentos.id', '=', 'trabajadores.departamento_id')
                                ->select('trabajadores.nombre_completo', 'trabajadores.id', 'equipos.id as id_equipo', 'equipos.nom_equipo', 'equipos.bm', 'departamentos.id as departamento')
                                ->where('trabajadores.id', '=', Auth::user()->trabajadores_id)
                                ->get();
            $datos = [];
            foreach ($query as $row)
            {
                $datos = $row;
            }
            return view('fallas.reportar', ['datos' => $datos]);      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $falla = new Falla;
        
        $falla->equipos_id = $request->equipos_id;
        $falla->trabajador_id = $request->trabajador_id;
        $falla->departamento_id = $request->departamento_id;
        $falla->descripcion = $request->descripcion;
        $falla->save();
        return redirect('fallas');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function traer_soportes(Request $request)
    {
        
        $soportes = Soporte::select('soportes.nombre_completo', 'soportes.id', 
                    DB::raw('(SELECT COUNT(*) as tareas from works where works.soporte_id = soportes.id and works.status = 0) as tareas'))
                    ->get();

        if($request->ajax())
        {
            return response()->json([
                    "soportes" => $soportes
                ]);
        }
    }

    public function traer_reportes(Request $request)
    {
        $reportes = Report::join('soportes', 'soportes.id', '=', 'reports.soporte_id')
                        ->select('reports.*', 'soportes.nombre_completo')
                        ->where('reports.falla_id', '=', $request->id)
                        ->get();

        if(count($reportes) > 0)
        {
            if($request->ajax())
            {
                return response()->json([
                    'reportes' => $reportes,
                    'respuesta' => true            
                ]);
            }
        }
        else
        {
            if($request->ajax())
            {
                return response()->json([
                    'respuesta' => false
                ]);
            }   
        }
    }

    public function traer_datos()
    {
        echo "aqui";
    }
}
