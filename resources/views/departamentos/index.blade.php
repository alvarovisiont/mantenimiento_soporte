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
			<div class="col-md-8 col-md-offset-2">
				<div class="alert alert-success" id="aviso" style="display: none;">
				 <h5 class="text-center">Departamento eliminado con éxito&nbsp;<i class="fa fa-exclamation-circle"></i></h5>
			    </div>
			</div>
		</div>
	<div class="row">
		<div class="col-md-12">
			<a href="{{url('departamentos/create')}}" class="btn btn-success btn-block">Registrar Departamento&nbsp;<i class="fa fa-plus"></i>&nbsp;<i class="fa fa-home"></i></a>	
		</div>
	</div>
	<div class="col-md-4 col-md-offset-4" id="barra_oculta" style="display:none">
		<br>
		<div class="progress progress-striped active">
			  	<div class="progress-bar progress-bar-danger" role="progressbar"
			       aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"
			       style="width: 100%">
			       <span>Eliminando...</span>
			    	<span class="sr-only">45% completado</span>
			  </div>
		</div>
	</div>
	<br>
	<table class="table table-bordered table-hover">
		<thead>
			<th class="text-center">Nombre</th>
			<th class="text-center">Descripción</th>
			<th class="text-center">Acción</th>
		</thead>
		<tbody class="text-center">
			@foreach($datos as $row)
				<?php
				?>
				<tr>
					<td>{{$row->nombre}}</td>
					<td>{{$row->descripcion}}</td>
					<td>
						<a href="{{url('departamentos/'.$row->id.'/edit')}}" class="btn btn-warning" title="Modificar"><i class="fa fa-edit"></i></a>
						<button class="btn btn-danger eliminar" data-id="{{$row->id}}" title="Eliminar"><i class="fa fa-trash"></i></button>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	{!! Form::open(['url' => 'departamentos/'.':USER', 'class' => 'form-horizontal', 'style' => 'display: inline-block', 'method' => 'DELETE', 'id' => 'formulario_eliminar']) !!}
	{!! Form::close() !!}
@endsection
@section('script')
	<script>
	$(function(){
		$("table").dataTable({
			"language" : {"url" : "json/esp.json"},
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
			var agree = confirm("Esta seguro de querer eliminar este registro?");
			return agree;
		}

		$(".eliminar").click(function(event) {
			var confirm = pregunta();

			if(confirm)
			{	
				$("#barra_oculta").show('slow/400/fast');
				var tr = $(this).parent().parent();
				var form = $("#formulario_eliminar");
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
						$("#aviso").removeClass('alert-danger').addClass('alert-success').empty().html('Equipo eliminado con éxito&nbsp;<i class="fa fa-exclamation-circle"></i>').show('slow/400/fast');
						setTimeout(function(){
							$("#aviso").hide('slow/400/fast');
						},2500);	
					}
					else
					{
						$("#barra_oculta").hide('slow/400/fast');
						var titulo = $("#aviso").children('h5');
						titulo.text('').append('No se puede borrar este registro porque esta asociado con algún trabajador u otro registro en el sistema&nbsp;&nbsp;<i class="fa fa-exclamation-circle"></i>');

						$("#aviso").removeClass('alert-success').addClass('alert-danger').show('slow/400/fast');
						
						setTimeout(function(){
							$("#aviso").hide('slow/400/fast');
						},3500);		
					}

				});
			}
			else
			{
				return false;
			}
		});
	});
	</script>
@endsection