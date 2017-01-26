@extends('layout.admin')

@section('contenido')
				<div class="form-group">
					<a href="{{url('equipos/create')}}" class="btn btn-primary btn-block btn-md">Agregar Equipo&nbsp;&nbsp;<i class="fa fa-desktop"></i></a>
				</div>
				<table class="table table-bordered table-hover table-condensed" id="tabla">
					<thead>
						<th class="text-center">Bien Mueble</th>
						<th class="text-center">Nom_Equipo</th>
						<th class="text-center">Usuario</th>
						<th class="text-center">Ip</th>
						<th class="text-center">Nº Fallas</th>
						<th class="text-center">Nº Atenciones Pendientes</th>
						<th class="text-center">Nº Actualizaciones</th>
						<th class="text-center">Descripción</th>
						<th class="text-center">Acción</th>
					</thead>
					<tbody class="text-center">
						@foreach($datos as $row)
							<?php
								$detalles = "<button class='btn btn-info btn-sm' data-toggle='modal' data-target='#modal_descripcion'
									data-descripcion='$row->descripcion'>Ver&nbsp;<i class='fa fa-search'></i></button>";
								$modificar = "<a href='".'{{url(equipos/'.$row->id.'/edit)}}'."' class='btn btn-warning btn-sm' title='editar'><i class='fa fa-edit'></i></a>";
							?>
							<tr data-id="{{$row->id}}">
								<td>{{$row->bm}}</td>
								<td>{{$row->nom_equipo}}</td>
								<td>{{$row->usuario}}</td>
								<td>{{$row->ip}}</td>
								<td></td>
								<td></td>
								<td></td>
								<td><?php echo $detalles; ?></td>
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
				      <div class="modal-header modal-header2" style="background-color: #FFF">
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				        <h3 class="text-center">Descripción del Equipo&nbsp;<i class="fa fa-desktop"></i></h3>
				      </div>
				      <div class="modal-body">
				      	<p id="descripcion" style="font-weight: bold; text-align: justify; text-indent: 10px; font-size:16px;"></p>
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
		
		$("#modal_descripcion").on('show.bs.modal', function(e){
			var x = $(e.relatedTarget).data().descripcion;
					$(e.currentTarget).find("#descripcion").html('');
					$(e.currentTarget).find("#descripcion").html(x);
		});

		function pregunta()
		{
			var agree = confirm("¿Esta seguro de querer borrar realmente este registro?");
			return agree;
		}

		$(".eliminar").click(function(e){

			confirm = pregunta();
			
			if(confirm)
			{
				var tr = $(this).parents('tr');
				var form = $(".formulario_eliminar");
				var id = $(this).data('eliminar');
				var ruta = form.attr('action').replace(':USER', id);
				var data = form.serialize();

				$.post(ruta, data, function(data){
					if(typeof(data.exito))
					{
						tr.hide('slow/400/fast');
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