@extends('layout.admin')

@section('contenido')
		
		<?php
			$x = 0;
		?>
		@if(Session::has('flash_create'))
			<div class="row">
				<div class="col-md-8 col-md-offset-2 ">
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
				 <h5 class="">Equipo eliminado con éxito&nbsp;<i class="fa fa-exclamation-circle"></i></h5>
			    </div>
			</div>
		</div>
		<div class="form-group">
			<a href="{{url('equipos/create')}}" class="btn btn-primary btn-block btn-md">Agregar Equipo&nbsp;&nbsp;<i class="fa fa-desktop"></i></a>
		</div>
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
		<table class="table table-bordered table-hover table-condensed" id="tabla">
			<thead>
				<th class="text-center">Bien Mueble</th>
				<th class="text-center">Nom_Equipo</th>
				<th class="text-center">Usuario</th>
				<th class="text-center">Ip</th>
				<th class="text-center">Nº Atenciones Pendientes</th>
				<th class="text-center">Status</th>
				<th class="text-center">Descripción</th>
				<th class="text-center">Acción</th>
			</thead>
			<tbody class="text-center">
				@foreach($datos as $row)
					<?php
						$modificar = "<a href='".'{{url(equipos/'.$row->id.'/edit)}}'."' class='btn btn-warning btn-sm' title='editar'><i class='fa fa-edit'></i></a>";
						
						$descripcion = "";

						if($row->tipo == "")
						{
							$descripcion = $row->caracteristicas_extras;
						}
						else
						{
							$descripcion = $row->tipo;
						}

						if($row->status == 0)
						{
							$status = "<span class='label label-success label-td'>Disponible</span>";
						}
						elseif($row->status == 1)
						{
							$status = "<span class='label label-primary label-td'>En uso</span>";	
						}
						elseif($row->status == 2)
						{
							$status = "<span class='label label-warning label-td'>En reparación</span>";	
						}
						else
						{
							$status = "<span class='label label-danger label-td'>Extraviada</span>";	
						}
					?>
					<tr data-id="{{$row->id}}">
						<td>{{ strtoupper($row->bm)}}</td>
						<td>{{$row->nom_equipo}}</td>
						<td>{{$row->nombre_completo}}</td>
						<td>{{$row->ip}}</td>
						<td>{{$row->pendientes}}</td>
						<td>@php echo $status; @endphp</td>
						<td>
							<a href="#modal_descripcion" class="btn btn-info" data-toggle="modal" 
							data-descripcion = "<?php echo $descripcion; ?>" 
							data-monitor = "{{$row->monitor}}"
							data-teclado = "{{$row->teclado}}"
							data-raton = "{{$row->raton}}"
							data-des_monitor = "{{$row->descripcion_monitor}}"
							data-des_teclado = "{{$row->descripcion_teclado}}"
							data-des_raton = "{{$row->descripcion_raton}}">Ver&nbsp;<i class="fa fa-search"></i></a>
						</td>
						<td>
							<a href="{{url('equipos/'.$row->id.'/edit')}}" class='btn btn-warning btn-sm' title='editar'><i class='fa fa-edit'></i></a>
							<button class="btn btn-danger btn-sm eliminar" title="eliminar" data-eliminar='{{$row->id}}'><i class="fa fa-trash"></i></button>
						</td>
					</tr>
				@endforeach

			</tbody>
		</table>
		<div class="modal fade" id="modal_descripcion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  	<div class="modal-dialog" role="document">
			    	<div class="modal-content">
				      <div class="modal-header" style="background-color: #2280E8; color: white;">
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				        <h3 class="text-center">Descripción del Equipo&nbsp;<i class="fa fa-desktop"></i></h3>
				      </div>
				      <div class="modal-body">
				      	<div class="row">
				      		<div class="col-md-12">
				      			<h3 class="text-center" style="color: darkred; text-decoration: underline">Descripción del CPU</h3>
				      			<p id="descripcion" style="text-align: justify; font-size:16px; white-space: pre-wrap;"></p>
				      		</div>
				      		<hr style="border-bottom: 1px solid lightgray">
				      		<div class="col-md-12">
				      			 <h3 class="text-center" style="color: darkred; text-decoration: underline">Descripción del Monitor: <strong id="bm_monitor"></strong></h3>
				      			 <p id="descripcion_monitor" style="text-align: justify; font-size:16px; white-space: pre-wrap;"></p>
				      		</div>
				      		<hr style="border-bottom: 1px solid lightgray">
				      		<div class="col-md-12">
				      			 <h3 class="text-center" style="color: darkred; text-decoration: underline">Descripción del Teclado: <strong id="bm_teclado"></strong></h3>
				      			 <p id="descripcion_teclado" style="text-align: justify; font-size:16px; white-space: pre-wrap;"></p>
				      		</div>
				      		<hr style="border-bottom: 1px solid lightgray">
				      		<div class="col-md-12">
				      			 <h3 class="text-center" style="color: darkred; text-decoration: underline">Descripción del Raton: <strong id="bm_raton"></strong></h3>
				      			 <p id="descripcion_raton" style="text-align: justify; font-size:16px; white-space: pre-wrap;"></p>
				      		</div>
				      	</div>
				      <div class="modal-footer">
				      	<button class="btn btn-danger" data-dismiss='modal'>Cerrar&nbsp;<i class="fa fa-remove"></i></button>
				      </div>
			    	</div>
				</div>
			</div>
		</div>

		{!! Form::open(['url' => 'equipos/'.':USER', 'class' => 'formulario_eliminar', 'style' => 'display: inline-block', 'method' => 'DELETE']) !!}
		{!! Form::close() !!}

@endsection

@section('script')
<script>
	$(function(){
		$("table").dataTable({
			"language": {"url" : "json/esp.json"}
		});

		var validacion = <?php echo $x; ?>; 
		if(validacion == 1)
		{
			setTimeout(function(){
				$(".alert-success").hide('slow/400/fast');
			}, 2500);
			
		}
		
		$("#modal_descripcion").on('show.bs.modal', function(e){
			var x = $(e.relatedTarget).data().descripcion;
					$(e.currentTarget).find("#descripcion").html('');
					$(e.currentTarget).find("#descripcion").html(x);
			var x = $(e.relatedTarget).data().monitor;
					$(e.currentTarget).find("#bm_monitor").html('');
					$(e.currentTarget).find("#bm_monitor").html(x);
			var x = $(e.relatedTarget).data().des_monitor;
					$(e.currentTarget).find("#des_monitor").html('');
					$(e.currentTarget).find("#descripcion_monitor").html(x);
			var x = $(e.relatedTarget).data().teclado;
					$(e.currentTarget).find("#bm_teclado").html('');
					$(e.currentTarget).find("#bm_teclado").html(x);
			var x = $(e.relatedTarget).data().des_teclado;
					$(e.currentTarget).find("#descripcion_teclado").html('');
					$(e.currentTarget).find("#descripcion_teclado").html(x);
			var x = $(e.relatedTarget).data().raton;
					$(e.currentTarget).find("#bm_raton").html('');
					$(e.currentTarget).find("#bm_raton").html(x);
			var x = $(e.relatedTarget).data().des_raton;
					$(e.currentTarget).find("#descripcion_raton").html('');
					$(e.currentTarget).find("#descripcion_raton").html(x);
		});

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
				var form = $(".formulario_eliminar");
				var id = $(this).data('eliminar');
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
				return confirm;	
			}
		});
	});
</script>
@endsection