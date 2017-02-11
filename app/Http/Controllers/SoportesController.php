<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Http\Requests;
use App\Http\Requests\SoporteRequest;
use Illuminate\Support\Facades\Redirect;
use App\Soporte;


use Illuminate\Support\Facades\DB;

class SoportesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datos = DB::table('soportes')->get();
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
        Session::flash('flash_message', 'Se ha registrado de manera exitosa!');
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
        return redirect('soportes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $soporte = Soporte::findOrfail($id);
        $soporte->delete();
        return redirect('soportes');
    }
}
