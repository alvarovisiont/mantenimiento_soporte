@extends('layout.admin')

@section('contenido')
	<div class="row">
		<div class="containter">
			<div class="col-md-12">
				<div class="form-group">
					<a href="{{url('equipos/create')}}" class="btn btn-primary btn-block btn-md">Agregar Equipo&nbsp;&nbsp;<i class="fa fa-desktop"></i></a>
				</div>
				<table class="table table-bordered table-hover table-condensed">
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
							<tr>
								<td>{{ strtoupper($row->bm)}}</td>
								<td>{{$row->nom_equipo}}</td>
								<td>{{$row->usuario}}</td>
								<td>{{$row->ip}}</td>
								<td></td>
								<td></td>
								<td></td>
								<td>

								<a href="" data-target="#modal-modificar-{{$row->id}}" data-toggle="modal"><button class="btn btn-info">Ver <i class="fa fa-search" aria-hidden="true"></i></button></a>

								 <a href="" data-target="#modal-actualizar-{{$row->id}}" data-toggle="modal"><button class="btn btn-danger">Actualizar <i class="fa fa-upload" aria-hidden="true"></i></button></a></td>
								<td>

								<a href="{{url('equipos/'.$row->id.'/edit')}}" class='btn btn-warning btn-sm' title='editar'><i class='fa fa-edit'></i></a>

									@include('equipos.eliminar', ['id' => $row->id])
								</td>
							</tr>
							    @include('equipos.modal')
						@endforeach

					</tbody>
				</table>
			</div>
		</div>
	</div>

<script>
	$(function(){
		/*$("#modal_descripcion").on('show.bs.modal', function(e){
			var x = $(e.relatedTarget).data().descripcion;
					$(e.currentTarget).find("#descripcion").html('');
					$(e.currentTarget).find("#descripcion").html(x);
		});
		$("#modal_actualizar").on('show.bs.modal', function(f){
			var x = $(f.relatedTarget).data().actualizar;
					$(f.currentTarget).find("#actualizar").html('');
					$(f.currentTarget).find("#actualizar").html(x);
		});*/

		function pregunta()
		{
			var agree = confirm("¿Esta seguro de querer borrar realmente este registro?");
			return agree;
		}

		$(".eliminar").click(function(){
			var confirm = pregunta();
			if(confirm)
			{
				return confirm;
			}
			else
			{
				return confirm;	
			}
		});
	});
</script>
@endsection