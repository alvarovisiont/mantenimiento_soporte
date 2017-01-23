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

Route::get('mantenimiento_soporte', function () {
    return view('auth.login');
});

Route::resource('departamentos', 'DepartamentosController');

//Rutas usuarios
Route::resource('usuarios', 'UsuariosController');
Route::patch('usuarios/{id}/edit',[
    'as' => 'usuarios.update',
    'uses' => 'UsuariosController@update'
]);

Route::auth();

Route::get('layout',function() {
	return view('layout.admin');
});
