<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\EquiposRequest;

use App\Equipos;

use App\Soporte;

use App\Characteristic_computer;

use Illuminate\Support\Facades\DB;

use Session;


class EquiposController extends Controller
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
        $model = new Equipos;
        $datos = Equipos::leftJoin('trabajadores', 'equipos.id', '=', 'trabajadores.equipos_id')
                ->leftJoin('characteristic_computers', 'equipos.tipo', '=', 'characteristic_computers.id')
                ->select('equipos.*', 'trabajadores.nombre_completo', 'characteristic_computers.tipo', DB::raw('(SELECT COUNT(*) from fallas where equipos_id = equipos.id and status = 0) as pendientes'))
                ->get();

        return view('equipos.index', ['datos' => $datos]);
    }

   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $equipo = new Equipos;

        $tipos = Characteristic_computer::pluck('id', 'id')->toArray();
        
        return view('equipos.crear', ['equipo' => $equipo, 'tipos' => $tipos]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EquiposRequest $request)
    {
        //
        $equipo = new Equipos;
        $equipo->create($request->all());
        Session::flash('flash_create', 'Registro creado con éxito');
        return redirect('equipos');

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
        $equipo = Equipos::find($id);
        $tipos = Characteristic_computer::lists('id', 'id')->toArray();
        return view('equipos.edit', ['equipo' => $equipo, 'tipos' => $tipos]);
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
        $equipo = Equipos::findOrFail($id);
        $equipo->fill($request->all());
        $equipo->save();
        Session::flash('flash_create', 'Equipo modificado con éxito');
        return redirect('equipos');
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
        if($request->ajax())
        {
            try
            {
                Equipos::destroy($id);
                return response()->json([
                    "exito" => "Usuario eliminado con éxito"
                ]);
                
                
            }
            catch(\Illuminate\Database\QueryException $e)
            {   
                return response()->json([
                    "false" => $e->getMessage()
                ]);
            }    
        }        
    }
}
