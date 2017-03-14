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

// ========================EQUIPOS CARACTERÍSTICAS ==============================

	Route::get('/equipos/caracteristicas', 'EquiposController@caracteristicas');
	
// =======================FALLAS==============================================//

	Route::get('/fallas/traer_soportes', 'FallasController@traer_soportes');
	Route::get('/fallas/traer_reportes','FallasController@traer_reportes');

// =======================SOPORTES==============================================//

	Route::get('/soportes/ver_reportes','WorksController@ver_reportes_soporte');

// =======================PDF==============================================//

	Route::get('/pdf/equipos','PdfController@index');
	Route::get('/pdf/departamentos','PdfController@pdf_departamentos');
	Route::get('/pdf/fallas','PdfController@pdf_fallas');
	Route::get('/pdf/mostrar_equipos','PdfController@mostrar_equipos');
	Route::get('/pdf/mostrar_departamentos','PdfController@mostrar_departamentos');
	Route::get('/pdf/mostrar_fallas','PdfController@mostrar_fallas');

// =======================CORRESPONDENCIA==============================================//
	
	Route::get('/correspondencia','CorrespondeciaController@index');
	Route::get('/correspondencia/enviados','CorrespondeciaController@enviados');
	Route::get('/correspondencia/basura','CorrespondeciaController@ver_basura');
	Route::get('/correspondencia/traerCorreos','CorrespondeciaController@traerCorreos');
	Route::get('/correspondencia/traerCorreosEnviados','CorrespondeciaController@traerCorreosEnviados');
	
	Route::get('/correspondencia/dialogo/{id}',[
			'as' => '/correspondencia/dialogo',
			'uses' => 'CorrespondeciaController@dialogo'
		]);
	Route::get('/correspondencia/dialogo_search/{id}',[
			'as' => '/correspondencia/dialogo_search',
			'uses' => 'CorrespondeciaController@dialogo_search'
		]);
	Route::get('/correspondencia/eliminar/{id}',[
			'as' => '/correspondencia/eliminar',
			'uses' => 'CorrespondeciaController@eliminar'
		]);
	Route::get('/correspondencia/eliminarUnico/{id}',[
			'as' => '/correspondencia/eliminarUnico',
			'uses' => 'CorrespondeciaController@eliminarUnico'
		]);
	Route::get('/correspondencia/eliminarPermanente/{id}',[
			'as' => '/correspondencia/eliminarPermanente',
			'uses' => 'CorrespondeciaController@eliminarPermanente'
		]);
	Route::get('/correspondencia/restaurar/{id}',[
			'as' => '/correspondencia/restaurar',
			'uses' => 'CorrespondeciaController@restaurar'
		]);

	Route::post('/correspondencia/create','CorrespondeciaController@create');

//================================ TAREAS ============================================//

	Route::post('/tareas/reportes', 'WorksController@reportes');
	Route::post('/tareas/reasignar', 'WorksController@reasignar');

//===========================RESOURCE========================================================//

Route::resource('departamentos', 'DepartamentosController');
Route::resource('equipos', 'EquiposController');
Route::resource('soportes', 'SoportesController');
Route::resource('trabajadores', 'TrabajadoresController');
Route::resource('actualizar', 'ActualizacionController');
Route::resource('fallas', 'FallasController');
Route::resource('tareas', 'WorksController');
Route::resource('usuarios', 'UsuariosController');

Route::patch('usuarios/{id}/edit',[
    'as' => 'usuarios.update',
    'uses' => 'UsuariosController@update'
]);
//================================= RUTAS AUTH =========================================================

	Route::auth();

//================================= PRINCIPAL =========================================================

	Route::get('escritorio',function() {

		$user = App\User::where('id_user', '=', Auth::user()->id_user)->firstOrFail();
		$user->online = 1;
		$user->save();

		if(Auth::user()->nivel != 3)
		{
			$equipos = App\Equipos::where('status', '<>', 3)->count();
			$fallas = App\Falla::whereNull('soporte_id')->count();
			$usuarios =  App\User::count();
			$mail = new App\Mail;
			$correos = $mail->cantidad_mensajes_nuevos();
			$falla = new App\Falla;
			$datos = $falla->traer_fallas();
			
			return view('escritorio.index',['equipos' => $equipos, 'fallas' => $fallas, 'usuarios' => $usuarios, 'correos' => $correos, 'datos' => $datos]);	
		}
	});

	Route::get('escritorioBienvenida',function() {

		$user = App\User::where('id_user', '=', Auth::user()->id_user)->firstOrFail();
		$user->online = 1;
		$user->save();

		if(Auth::user()->nivel != 3)
		{
			$equipos = App\Equipos::where('status', '<>', 3)->count();
			$fallas = App\Falla::whereNull('soporte_id')->count();
			$usuarios =  App\User::count();
			$mail = new App\Mail;
			$correos = $mail->cantidad_mensajes_nuevos();
			$falla = new App\Falla;
			$datos = $falla->traer_fallas();
			
			return view('escritorio.bienvenida',['equipos' => $equipos, 'fallas' => $fallas, 'usuarios' => $usuarios, 'correos' => $correos, 'datos' => $datos, 'bienvenida' => 'Bienvenido al sistema: '.Auth::user()->usuario]);	
		}

	});



	
