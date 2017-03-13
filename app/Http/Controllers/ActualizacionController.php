<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Equipos;
use App\Soporte;
use App\Actualizaciones;
use Illuminate\Support\Facades\DB;
use Session;

class ActualizacionController extends Controller
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
        $datos = DB::table('actualizaciones')
                ->join('soportes', 'soportes.id', '=', 'actualizaciones.soportes_id')
                ->join('equipos', 'equipos.id', '=', 'actualizaciones.equipos_id')
                ->select('actualizaciones.descripcion', 'actualizaciones.created_at', 'actualizaciones.id', 'equipos.bm', 'soportes.nombre_completo')
                ->get();
        return view('actualizacion.index', ['datos' => $datos]); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $equipos = Equipos::lists('bm', 'id');
        $soportes = Soporte::lists('nombre_completo', 'id');
        $actualizacion = new Actualizaciones;
        return view('actualizacion.create', ['equipos' => $equipos, 'soportes' => $soportes, 'actualizacion' => $actualizacion]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datos = new Actualizaciones();
        $datos->create($request->all());
        
        Session::flash('flash_create', 'Actualización registrada con éxito');
        return redirect('actualizar');
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
        $equipos = Equipos::lists('bm', 'id');
        $soportes = Soporte::lists('nombre_completo', 'id');
        $actualizacion = Actualizaciones::find($id);
        return view('actualizacion.edit', ['equipos' => $equipos, 'soportes' => $soportes, 'actualizacion' => $actualizacion]);

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
        $datos = Actualizaciones::findOrFail($id);
        $datos->fill($request->all());
        $datos->save();
        Session::flash('flash_create', 'Registro Modificado con éxito');
        return redirect('actualizar');
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
        Actualizaciones::destroy($id);
    }
}
