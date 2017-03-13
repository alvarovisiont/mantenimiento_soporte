@extends('layout.admin')

@section('contenido')
	{!! Form::open(['url' => 'pdf/mostrar_fallas', 'method' => 'GET', 'id' => 'form_agregar', 'class' => 'form-horizontal']) !!}
		
		<div class="form-group">
			{!! Form::label('equipo', 'Equipo', ['class' => 'control-label col-md-2']) !!}
			<div class="col-md-4">
				{!! Form::select('equipo', [null => ''] + $fallas->equipos(), null, ['class' => 'form-control']) !!}
			</div>
			{!! Form::label('departamento', 'Departamento', ['class' => 'control-label col-md-2']) !!}
			<div class="col-md-4">
				{!! Form::select('departamento', [null => ''] + $fallas->departamentos(), null, ['class' => 'form-control']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('trabajador', 'Trabajador', ['class' => 'control-label col-md-2']) !!}
			<div class="col-md-4">
				{!! Form::select('Trabajador', [null => ''] + $fallas->trabajadores(), null, ['class' => 'form-control']) !!}
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-offset-2 col-md-4">
				<button type="button" class="btn btn-primary btn-block" id="ver_reportes">Mostrar Reporte&nbsp;<i class="fa fa-arrow-down"></i></button>
			</div>
			<div class="col-md-4">
				<button type="submit" class="btn btn-danger btn-block">Descargar Reporte&nbsp;<i class="fa fa-download"></i></button>
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
				<th class="text-center">Trabajador</th>
				<th class="text-center">Equipo</th>
				<th class="text-center">Departamento</th>
				<th class="text-center">Descripción</th>
				<th class="text-center">Status</th>
				<th class="text-center">Fecha Registro</th>
			</tr>
		</thead>
		<tbody>
			
		</tbody>
	</table>
@endsection

@section('script')
	<script>
		$(function(){
			$("#ver_reportes").click(function(event) {
				var form = $("#form_agregar"),
					data = form.serialize(),
					ruta = form.attr('action');

				$("#tabla").children('tbody').empty();

				$("#barra_oculta").show('slow/400/fast');

				$.get(ruta, data, function(data){

					if(data['datos'] != false)
					{
						$("#barra_oculta").hide('slow/400/fast');					
						
						var filas = "";
						var status = "";

						$.grep(data['datos'], function(e,i)
						{
							status = "";

							if(e.status == 0)
							{
								status = "En espera";	
							}
							else
							{
								status = "Atendida";	
							}

							filas += "<tr><td>"+e.trabajador+"</td><td>"+e.nom_equipo+" - "+e.bm+"</td><td>"+e.departamento+"</td><td>"+e.descripcion+"</td><td>"+status+"</td><td>"+e.created_at+"</td></tr>";
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