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

Route::get('/', function () {
    return view('auth.login');
});

Route::get('departamentos', 'DepartamentosController@index');

Route::put('departamentos', 'DepartamentosController@modificar');

//Route::post('log/store','LogController@store');
Route::resource('log','LogController@store');

Route::auth();

Route::get('layout',function() {
	return view('layout.admin');
});

Route::auth();

Route::get('layout', 'HomeController@index');
