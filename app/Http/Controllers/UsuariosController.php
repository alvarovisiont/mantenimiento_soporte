<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Soporte;
use App\Trabajadores;
use Session;


class UsuariosController extends Controller
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
            $datos= User::leftJoin('trabajadores', 'users.trabajadores_id', '=', 'trabajadores.id')
                        ->leftJoin('soportes', 'users.trabajadores_id', '=', 'soportes.id')
                        ->select('users.*', 'trabajadores.nombre_completo', 'soportes.nombre_completo as nombre_soporte')

                        ->get();
            return view('usuarios.index', ['datos' => $datos]);
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $trabajadores = Trabajadores::select('nombre_completo', 'id')->whereNotIn('id', function($query)
        {
            $query->select('trabajadores_id')->from('users')->where('nivel', '=', '3')->orwhere('nivel', '=', '1');
        })
        ->pluck('nombre_completo', 'id')->toArray();

        $soportes = Soporte::select('nombre_completo', 'id')->whereNotIn('id', function($query)
        {
            $query->select('trabajadores_id')->from('users')->where('nivel', '=', '2');
        })
        ->pluck('nombre_completo', 'id')->toArray();
        

        return view('usuarios.create', ['trabajadores' => $trabajadores, 'soportes' => $soportes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegisterRequest $request)
    {
            $id = "";
            $tipo = "";

            if($request->soportes_id == "")
            {
                $id = $request->trabajadores_id;
                $tipo = 1;
            }
            else
            {
                $id = $request->soportes_id;   
                $tipo = 2;
            }

            $usuarios= new User;
            $usuarios->trabajadores_id = $id;
            $usuarios->usuario = $request->usuario;
            $usuarios->password = bcrypt($request->password);
            $usuarios->nivel = $request->nivel;
            $usuarios->tipo = $tipo;
            $usuarios->save();
            Session::flash('flash_create', 'Usuario creado con éxito');
             return Redirect::to('usuarios');
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
         $usuarios=User::findOrfail($id);

        //return view("almacen.articulo.edit",["articulo"=>$articulo,"categorias"=>$categorias]);
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
        $user = User::findOrfail($id);
        $user->usuario = $request->usuario;
        $user->password = bcrypt($request->password);
        $user->nivel = $request->nivel;
        //dd($user);
        $user->update();
        Session::flash('flash_create', 'Usuario modificado con éxito');
        return redirect('usuarios');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $persona= User::findOrfail($id);
        $persona->delete();
       Session::flash('flash_message', 'Se ha eliminado de manera exitosa!');
             return Redirect::to('usuarios');


    }
}
