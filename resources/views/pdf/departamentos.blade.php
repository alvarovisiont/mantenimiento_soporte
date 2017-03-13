@extends('layout.admin')

@section('contenido')
	{!! Form::open(['url' => 'pdf/mostrar_departamentos', 'method' => 'GET', 'class' => 'form-horizontal', 'id' => 'form_reporte']) !!}
		<div class="form-group">
			{!! Form::label('departamentos', 'Departamentos', ['class' => 'control-label col-md-2']) !!}
			<div class="col-md-4">
				{!! Form::select('departamentos', [null => ''] + $departamentos->departamentos(), null, ['class' => 'form-control', 'id' => 'departamentos']) !!}	
			</div>
			<div class="col-md-3">
				<button type="button" class="btn btn-primary btn-block" id="ver_reporte">Ver Reportes&nbsp;<i class="fa fa-arrow-down"></i></button>
			</div>
			<div class="col-md-3">
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
				<th class="text-center">Departamento</th>
				<th class="text-center">Trabajador</th>
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
	<script>
		$(function(){

			$("#ver_reporte").click(function(){

				$("#tabla").children('tbody').empty();

				$("#barra_oculta").show('slow/400/fast');

				var departamento = $("#departamentos").val(),
					form = $("#form_reporte"),
					ruta = form.attr('action');

				$.ajax({
					url: ruta,
					type: "GET",
					dataType: "JSON",
					data: {departamento: departamento},
				})
				.done(function(data){
					if(data['datos'] != false)
					{
						$("#barra_oculta").hide('slow');

						var filas = "";
						var caracteristicas = "";
						var status = "";

						$.each(data['datos'],function(i,e)
						{
							caracteristicas = "";
							status = "";

							if(e.caracteristicas == "")
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
								status = "En reparación";	
							}
							else
							{
								status = "Extraviada";	
							}

							filas += "<tr><td>"+e.departamento+"</td><td>"+e.trabajador+"</td><td>"+e.bm+"</td><td>"+e.nom_equipo+"</td><td>"+e.ip+"</td><td>"+e.monitor+"</td><td>"+e.raton+"</td><td>"+e.teclado+"</td><td>"+caracteristicas+"</td><td>"+e.color+"</td><td>"+status+"</td></tr>";
						});

						$("#tabla").children('tbody').html(filas);
					}
					else
					{
						$("#barra_oculta").hide('slow');
						$("#aviso").show('slow/400/fast', function(){
							setTimeout(function(){
								$("#aviso").hide('slow');
							}, 3000);
						});
							
					}
				});
				
			});
		});
	</script>
@endsection