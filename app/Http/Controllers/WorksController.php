<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\Auth;

use App\Work;

use App\Falla;

use App\Report;

use Session;

class WorksController extends Controller
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
        $works = Work::join('trabajadores','trabajadores.id', '=', 'works.trabajadores_id')
                    ->join('equipos','equipos.id', '=', 'works.equipo_id')
                    ->select('works.*', 'equipos.bm', 'equipos.nom_equipo', 'trabajadores.nombre_completo')
                    ->where('works.soporte_id', '=', Auth::user()->trabajadores_id)
                    ->get();
        return view('tareas.index', ['works' => $works]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $tarea = new Work;
        $tarea->falla_id = $request->falla_id;
        $tarea->trabajadores_id = $request->trabajadores_id;
        $tarea->soporte_id = $request->soporte_id;
        $tarea->descripcion = $request->descripcion;
        $tarea->equipo_id = $request->equipo_id; 
        $tarea->fecha_tarea = date('Y-m-d H:i:s', strtotime($request->fecha_tarea));
        $tarea->status = 0;
        $tarea->save();

        $falla = Falla::where('id', '=', $request->falla_id)->firstOrFail();

        $falla->soporte_id = $request->soporte_id;

        $falla->save();

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
        //;

        $falla = Falla::findOrFail($id);
        $falla->status = 1;
        $falla->save();

        $work = Work::where('falla_id', '=', $id)->firstOrFail();

        $work->status = 1;

        $work->save();
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

    public function reportes(Request $request)
    {

        $reporte = new Report;

        $hasValid = $request->hasFile('imagenes');

        $archivosName = "";

        if($hasValid)
        {   
            foreach ($request->file('imagenes') as $files) 
            {
                $imageName = $files->getClientOriginalName();
                $archivosName .= $imageName.",";
                $path = base_path().'/public/img/reportes/';
                $files->move($path , $imageName);
            }
        }

        $archivosName = substr($archivosName, 0, strlen($archivosName) -1);

        $reporte->falla_id = $request->falla_id;
        $reporte->soporte_id = $request->soporte_id;
        $reporte->trabajador_id = $request->trabajador_id;
        $reporte->cuerpo_reporte = $request->cuerpo_reporte;
        $reporte->imagenes = $archivosName;  
        $reporte->save();

        Session::flash('flash_create', 'Reporte creado con éxito');

        return redirect('tareas');
    }

    public function reasignar(Request $request)
    {
        $falla = Falla::where('id', '=', $request->falla_id)->firstOrFail();
        $falla->soporte_id = $request->soporte_id;
        $falla->save();

        $work = Work::where('falla_id', '=', $request->falla_id)->firstOrFail();
        $work->soporte_id = $request->soporte_id;
        $work->save();
    }

    public function ver_reportes_soporte()
    {
        $works = Work::join('trabajadores','trabajadores.id', '=', 'works.trabajadores_id')
                    ->join('equipos','equipos.id', '=', 'works.equipo_id')
                    ->select('works.*', 'equipos.bm', 'equipos.nom_equipo', 'trabajadores.nombre_completo')
                    ->where('works.soporte_id', '=', Auth::user()->trabajadores_id)
                    ->get();
        return view('tareas.ver_reportes', ['works' => $works]);
    }
}
