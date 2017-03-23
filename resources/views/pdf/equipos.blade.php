@extends('layout.admin')

@section('contenido')

	{!! Form::open(['url' => 'pdf/mostrar_equipos', 'method' => 'GET', 'class' => 'form-horizontal', 'id' => 'form_reporte']) !!}
		{!! Form::hidden('accion',null, ['id' => 'accion']) !!}
		<div class="form-group">
			{!! Form::label('bm_equipo', 'Bm del equipo', ['class' => 'control-label col-md-2']) !!}
			<div class="col-md-2">
				{!! Form::select('bm_equipo', [null => ''] + $bm_equipo->bm_equipos(), null, ['class' => 'form-control']) !!}	
			</div>
			{!! Form::label('nom_equipo', 'Nombre equipo', ['class' => 'control-label col-md-2']) !!}
			<div class="col-md-2">
				{!! Form::select('nom_equipo', [null => ''] + $bm_equipo->nombre_equipos(), null, ['class' => 'form-control']) !!}	
			</div>
			{!! Form::label('color', 'Color', ['class' => 'control-label col-md-2']) !!}
			<div class="col-md-2">
				{!! Form::select('color', ['' => ''] + ['Negro' => 'Negro','Blanco' => 'Blanco',  'Gris' => 'Gris', 'Verde' => 'Verde', 'Amarillo' => 'Amarillo' , 'Rojo' => 'Rojo', 'Rosado' => 'Rosado', 'Marron' => 'Marron'], null, ['class' => 'form-control']) !!}	
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('bm_monitor', 'BM del monitor', ['class' => 'control-label col-md-2']) !!}
			<div class="col-md-2">
				{!! Form::select('bm_monitor', ['' => ''] + $bm_equipo->bm_monitor(), null, ['class' => 'form-control']) !!}	
			</div>
			{!! Form::label('bm_raton', 'BM del raton', ['class' => 'control-label col-md-2']) !!}
			<div class="col-md-2">
				{!! Form::select('bm_raton', ['' => ''] + $bm_equipo->bm_raton(), null, ['class' => 'form-control']) !!}	
			</div>
			{!! Form::label('bm_teclado', 'BM del teclado', ['class' => 'control-label col-md-2']) !!}
			<div class="col-md-2">
				{!! Form::select('bm_teclado', ['' => ''] + $bm_equipo->bm_teclado(), null, ['class' => 'form-control']) !!}	
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('fecha_desde', 'Fecha Ingreso Desde', ['class' => 'control-label col-md-2']) !!}
			<div class="col-md-4">
				{!! Form::text('fecha_desde', null,['class' => 'form-control']) !!}	
			</div>
			{!! Form::label('fecha_hasta', 'Fecha Ingreso Hasta', ['class' => 'control-label col-md-2']) !!}
			<div class="col-md-4">
				{!! Form::text('fecha_hasta', null,['class' => 'form-control']) !!}	
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-offset-3 col-md-3">
				<button type="button" class="btn btn-primary btn-block" id="ver_reporte">Ver Reporte&nbsp;<i class="fa fa-file-pdf-o"></i></button>
			</div>
			<div class="col-md-3">
				<button type="submit" class="btn btn-danger btn-block">Descargar Reporte&nbsp;<i class="fa fa-file-pdf-o"></i></button>
			</div>
		</div>
		<br>
		<div class="form-group">
			<div class="col-md-4 col-md-offset-4" id="barra_oculta" style="display:none">
				<div class="progress progress-striped active">
					  	<div class="progress-bar progress-bar-warning" role="progressbar"
					       aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"
					       style="width: 100%">
					       <span>Cargando...</span>
					    	<span class="sr-only">45% completado</span>
					  </div>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-offset-4 col-md-4">
				<p class="alert alert-info text-center" id="aviso" style="display:none">No hay datos para realizar este reporte&nbsp;<i class="fa fa-exclamation-circle"></i></p>
			</div>
		</div>
	{!! Form::close() !!}


	<table class="table table-responsive table-bordered table-hover table-condensed" id="tabla">
		<thead>
			<tr>
				<th class="text-center">BM_equipo</th>
				<th class="text-center">Nom_equipo</th>
				<th class="text-center">IP</th>
				<th class="text-center">BM_MONITOR</th>
				<th class="text-center">BM_RATÓN</th>
				<th class="text-center">BM_TECLADO</th>
				<th class="text-center">Caracteristicas</th>
				<th class="text-center">Color</th>
				<th class="text-center">Status</th>
			</tr>
		</thead>
		<tbody>
			
		</tbody>
	</table>
@endsection

@section('script')
	<script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
	<script src="{{ asset('js/bootstrap-datepicker.es.min.js') }}"></script>

	<script>
		$(function(){
			$("#fecha_desde").datepicker({
				format: "dd-mm-yyyy"
			}).on('changeDate', function(){
				$(this).datepicker('hide');
			});

			$("#fecha_hasta").datepicker({
				format: "dd-mm-yyyy"
			}).on('changeDate', function(){
				$(this).datepicker('hide');
			});

			$("#ver_reporte").click(function(event) {

				$("#barra_oculta").show('slow/400/fast');

				$("#tabla").children('tbody').empty();
				$("#accion").val('mostrar');
				var form = $("#form_reporte"),
					datos = form.serialize(),
					ruta = form.attr('action');

				$.get(ruta, datos, function(data){

					if(data['datos'] != false)
					{
						$("#barra_oculta").hide('slow/400/fast');					
						
						var filas = "";
						var caracteristicas = "";
						var status = "";

						$.grep(data['datos'], function(e,i)
						{
							caracteristicas = "";
							status = "";


							if(e.caracteristicas == "" || e.caracteristicas == null)
							{
								caracteristicas = e.caracteristicas_extras;
							}
							else
							{
								caracteristicas = e.caracteristicas;
							}

							if(e.status == 0)
							{
								status = "Disponible";
							}
							else if(e.status == 1)
							{
								status = "En uso";	
							}
							else if(e.status == 2)
							{
								status = "Dañada";	
							}
							else
							{
								status = "Extraviada";	
							}

							filas += "<tr><td>"+e.bm+"</td><td>"+e.nom_equipo+"</td><td>"+e.ip+"</td><td>"+e.monitor+"</td><td>"+e.raton+"</td><td>"+e.teclado+"</td><td>"+caracteristicas+"</td><td>"+e.color+"</td><td>"+status+"</td></tr>";
						});

						$("#tabla").children('tbody').html(filas);
					}
					else
					{	
						$("#barra_oculta").hide('slow/400/fast');

						$("#aviso").show('slow/400/fast', function(){
							setTimeout(function(){
								$("#aviso").hide('slow');
							},2500);
						});
					}
						
				});
			});

		});
	</script>
@endsection