<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

use App\Http\Requests\TrabajadoresRequest;

use App\Trabajadores;
use App\Departamentos;
use App\Equipos;

use Session;

class TrabajadoresController extends Controller
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
        $datos = Trabajadores::join('departamentos', 'departamentos.id', '=', 'trabajadores.departamento_id')
                            ->join('equipos', 'equipos.id', '=', 'trabajadores.equipos_id')
                            ->select('trabajadores.*', 'equipos.bm', 'departamentos.nombre')
                            ->get();
        return view('trabajadores.index', ['datos' => $datos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departamentos = Departamentos::lists('nombre', 'id');
        $equipos = Equipos::lists('bm', 'id');
        $trabajador = new Trabajadores;
        return view('trabajadores.create', ['trabajador' => $trabajador, 'departamentos' => $departamentos, 'equipos' => $equipos]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TrabajadoresRequest $request)
    {
        //
        $trabajador = new Trabajadores;
        $trabajador->create($request->all());

        $equipos = Equipos::where('id', '=', $request->equipos_id)->firstOrFail();
        $equipos->status = 1;
        $equipos->save();

        Session::flash('flash_create', 'Trabajador creado con éxito');

        return Redirect::to('trabajadores');

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
        $trabajador = Trabajadores::find($id);
        $departamentos = Departamentos::lists('nombre', 'id');
        $equipos = Equipos::lists('bm', 'id');
        return view('trabajadores.edit', ['trabajador' => $trabajador, 'departamentos' => $departamentos, 'equipos' => $equipos]);
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
        $trabajador = Trabajadores::findOrFail($id);
        $trabajador->fill($request->all());
        $trabajador->save();
        Session::flash('flash_create', 'Trabajador modificado con éxito');
        return redirect('trabajadores');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        //
        $trabajadores = Trabajadores::where('id', '=', $id)->firstOrFail();
        
        $equipos = Equipos::where('id', '=', $trabajadores->equipos_id)->firstOrFail();
        $equipos->status = 0;
        $equipos->save();

        Trabajadores::destroy($id);

        if($request->ajax())
        {
            return response()->json([
                    "exito" => "Usuario eliminado con éxito"
                ]);
        }
    }
}
