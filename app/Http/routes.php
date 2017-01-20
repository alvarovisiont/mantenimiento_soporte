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

//Raiz , si estan en la raiz , va a la vista de login
Route::get('/', function () {
    return view('auth.login');
});

//Departamentos CRUD
Route::get('departamentos', 'DepartamentosController@index');
Route::put('departamentos', 'DepartamentosController@modificar');


//Rutas de login
Route::auth();

Route::get('layout',function() {
	return view('layout.admin');
});

Route::get('layout', 'HomeController@index');
