@extends('layout.admin')

@section('contenido')
		<?php
			$x = 0;
		?>
		@if(Session::has('flash_create'))
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<div class="alert alert-success">
					 <h5 class="text-center">{{Session::get('flash_create')}}&nbsp;<i class="fa fa-exclamation-circle"></i></h5>
				    </div>
				</div>
			</div>
			 <?php 
			 	$x = 1;
			 ?>
		@endif
		<div class="row">
			<div class="col-md-8 col-md-offset-2 text-center">
				<div class="alert alert-success" id="aviso" style="display: none;">
				 <h5 class=""></h5>
			    </div>
			</div>
		</div>
	<div class="row">
		<div class="col-md-12">
			<a class="btn btn-success btn-block" href="{{url('soportes/create')}}">Agregar Soporte&nbsp;&nbsp;<i class="fa fa-user-plus" aria-hidden="true"></i></a>
		</div>
	</div>
	<br>
	<div class="form-group">
		<div class="col-md-4 col-md-offset-4" id="barra_oculta" style="display:none">
			<div class="progress progress-striped active">
				  	<div class="progress-bar progress-bar-danger" role="progressbar"
				       aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"
				       style="width: 100%">
				       <span>Eliminando...</span>
				    	<span class="sr-only">45% completado</span>
				  </div>
			</div>
		</div>
	</div>
	<br>
		<table class="table table-bordered table-hover" id="tabla">
			<thead>
				<tr>
					<th class="text-center">Nombre_Completo</th>
					<th class="text-center">Cédula</th>
					<th class="text-center">Nº de Tareas</th>
					<th class="text-center">Nº de Actualizaciones</th>
					<th class="text-center">Accion</th>
				</tr>
			</thead>
			<tbody class="text-center">
				@foreach($datos as $row)
					<tr>
						<td>{{$row->nombre_completo}}</td>
						<td>{{$row->cedula}}</td>
						<td>{{$row->tareas}}</td>
						<td>{{$row->actualizaciones}}</td>
						<td>
							<a href="#" data-target="#modal-modificar-{{$row->id}}" data-toggle="modal"><button class="btn btn-info">Modificar</button></a>
							<a href="#" data-id ="{{$row->id}}" class="btn btn-danger eliminar">Eliminar</a>
						</td>
					</tr>
					@include('soportes.modal')
				@endforeach
			</tbody>
		</table>
{!!Form::open(['url'=>'soportes/'.":USER", 'method' =>'delete','id' =>'form_eliminar']) !!}
{!! Form::close() !!}
@endsection

@section('script')
	<script>
		$(document).ready(function(){
			$("#tabla").dataTable({
				"language" : {"url" : "json/esp.json"}
			});

			var validacion = <?php echo $x; ?>; 
			if(validacion == 1)
			{
				setTimeout(function(){
					$(".alert-success").hide('slow/400/fast');
				}, 2500);
				
			}

			function pregunta()
			{
				var agree = confirm("¿Esta seguro de querer borrar realmente este registro?");
				return agree;
			}

			$(".eliminar").click(function(e){

				var confirm = pregunta();
				
				if(confirm)
				{
					$("#barra_oculta").show('slow/400/fast');
					var tr = $(this).parent().parent();
					var form = $("#form_eliminar");
					var id = $(this).data('id');
					var ruta = form.attr('action').replace(':USER', id);
					var data = form.serialize();

					$.ajax({
						url: ruta,
						type:'POST',
						dataType: 'JSON',
						data: data,
					})
					.done(function(data){
						if(typeof(data.exito) != "undefined")
						{
							$("#barra_oculta").hide('slow/400/fast');
							tr.remove();
							$("#aviso").removeClass('alert-danger').addClass('alert-success').empty().html('Soporte eliminado con éxito&nbsp;<i class="fa fa-exclamation-circle"></i>').show('slow/400/fast');
							setTimeout(function(){
								$("#aviso").hide('slow/400/fast');
							},2500);	
						}
						else
						{
							$("#barra_oculta").hide('slow/400/fast');

							var titulo = $("#aviso").children('h5');
							titulo.text('').append('No se puede borrar este registro porque esta asociado con alguna tarea u otro registro en el sistema&nbsp;&nbsp;<i class="fa fa-exclamation-circle"></i>');

							$("#aviso").removeClass('alert-success').addClass('alert-danger').show('slow/400/fast');
							
							setTimeout(function(){
								$("#aviso").hide('slow/400/fast');
							},3500);		
						}
					});
				}
				else
				{
					return confirm;	
				}
			});
		});
	</script>
@endsection