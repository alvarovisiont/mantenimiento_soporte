<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\RegisterRequest;
use Session;
use Illuminate\Support\Facades\Redirect;
use App\User;
use DB;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
             $datos=DB::table('users')
            ->select('*')
            ->paginate(5);

        return view('usuarios.index', ['datos' => $datos]);
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('usuarios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegisterRequest $request)
    {

            $usuarios= new User;
            $usuarios->cedula = $request->get('cedula');
            $usuarios->name = $request->get('name');
            $usuarios->apellido = $request->get('apellido');
            $usuarios->usuario = $request->get('usuario');
            $usuarios->password = bcrypt($request->get('password'));
            $usuarios->nivel = $request->get('nivel');
            $usuarios->save();
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
        $user->fill($request->all());
        //dd($user);
        $user->update();
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
        $persona->fill($request->all());
        $persona->delete();
       Session::flash('flash_message', 'Se ha eliminado de manera exitosa!');
             return Redirect::to('usuarios');


    }
}
