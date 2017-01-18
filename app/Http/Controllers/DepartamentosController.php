<?php

namespace App\Http\Controllers;

use Request;

use App\Departamentos;

use Illuminate\Support\Facades\DB;

class DepartamentosController extends Controller
{
     public function index()
    {
        $datos = DB::table('departamentos')->get();

        return view('departamentos/admin/index', ['datos' => $datos]);
    }

    public function modificar(Request $request)
    {
    	$id = $_POST['id_modi'];
    	$user = Departamentos::findOrFail($id);
    	$user->fill(Request::all());
    	$user->save();
    }
}
