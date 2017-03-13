<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

use App\Http\Requests;
use App\Http\Requests\SoporteRequest;

use App\Soporte;
use Session;



class SoportesController extends Controller
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
        $datos = Soporte::select('*', DB::raw('(SELECT count(*) from actualizaciones where soportes_id = soportes.id) as actualizaciones'), DB::raw('(SELECT COUNT(*) as tareas from works where works.soporte_id = soportes.id) as tareas'))
            ->get();
        return view('soportes.index', ['datos' => $datos]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('soportes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SoporteRequest $request)
    {
        
        $soporte = new Soporte();
        $soporte->fill($request->all());
        $soporte->save();
        Session::flash('flash_create', 'Se ha registrado de manera exitosa');
        return Redirect::to('soportes');
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
        $soporte = Soporte::findOrfail($id);
        $soporte->fill($request->all());
        //dd($user);
        $soporte->update();
        Session::flash('flash_create', 'Se ha modificado de manera exitosa');
        return redirect('soportes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        if($request->ajax())
        {
            try
            {
                Soporte::destroy($id);
                return response()->json([
                    "exito" => "Soporte eliminado con éxito"
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
