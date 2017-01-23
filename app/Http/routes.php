<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

<<<<<<< HEAD
Route::get('mantenimiento_soporte', function () {
    return view('auth.login');
});

Route::resource('departamentos', 'DepartamentosController');
=======
//Raiz , si estan en la raiz , va a la vista de login
Route::get('/', function () {
    return view('auth.login');
});

//Departamentos CRUD
Route::get('departamentos', 'DepartamentosController@index');
Route::put('departamentos', 'DepartamentosController@modificar');

//Rutas usuarios
Route::get('usuarios',function () {
	return view('usuarios.index');
});
Route::get('usuarios/ver', 'UsuariosController@index');


//Rutas de login
Route::auth();
>>>>>>> 11cd86af7de12548ebfb2dda2900665b4875eb90

Route::get('layout',function() {
	return view('layout.admin');
});

<<<<<<< HEAD
Route::auth();


//Route::get('layout', 'HomeController@index');
=======
Route::get('layout', 'HomeController@index');
>>>>>>> 11cd86af7de12548ebfb2dda2900665b4875eb90
