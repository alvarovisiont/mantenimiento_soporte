<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

use App\Departamentos;

use Session;


class DepartamentosController extends Controller
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
        $datos = Departamentos::all();
        return view('departamentos.index', ['datos' => $datos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $departamentos = new Departamentos;
        return view('departamentos.crear', ['departamentos' => $departamentos]);
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
        $departamento = new Departamentos;
        $departamento->nombre = $request->nombre;
        $departamento->descripcion = $request->descripcion;
        $departamento->save();
        Session::flash('flash_create', 'Departamento creado con éxito');
        return Redirect::to('departamentos');
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
        $departamento = Departamentos::find($id);
        return view("departamentos.edit", ['departamentos' => $departamento]);
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
        $user = Departamentos::findOrFail($id);
        $user->fill($request->all());
        $user->save();
        Session::flash('flash_create', 'Departamento modificado con éxito');
        return Redirect::to('departamentos');
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
                Departamentos::destroy($id);
                return response()->json([
                    "exito" => "Departamento eliminado con éxito"
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
