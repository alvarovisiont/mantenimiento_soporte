<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Requests\EquiposRequest;

use App\Equipos;
use App\Soporte;

use Illuminate\Support\Facades\DB;


class EquiposController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datos = Equipos::all();
        $soporte = Soporte::all();
        return view('equipos.index', ['datos' => $datos , 'soporte' => $soporte]);


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
        return view('equipos.crear', ['equipo' => $equipo]);
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
        $equipo->fill($request->all());
        $equipo->save();
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
        return view('equipos.edit', ['equipo' => $equipo]);
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
        Equipos::destroy($id);

        if($request->ajax())
        {
            return response()->json([
                    "exito" => "Usuario eliminado con éxito"
                ]);
        }
    }
}
