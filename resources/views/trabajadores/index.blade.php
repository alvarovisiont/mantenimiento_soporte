@extends('layout.admin')

@section('contenido')
				<div class="form-group">
					<a href="{{url('trabajadores/create')}}" class="btn btn-primary btn-block btn-md">Agregar Trabajador&nbsp;&nbsp;<i class="fa fa-users"></i></a>
				</div>
				<table class="table table-bordered table-hover table-condensed" id="tabla">
					<thead>
						<th class="text-center">Nombre y Apellido</th>
						<th class="text-center">Departamento</th>
						<th class="text-center">Equipo</th>
						<th class="text-center">Télefono</th>
						<th class="text-center">Cédula</th>
						<th class="text-center">Email</th>
						<th class="text-center">Acción</th>
					</thead>
					<tbody class="text-center">
						@if($datos != "")
							@foreach($datos as $row)
								<tr data-id="{{$row->id}}">
									<td>{{$row->nombre_completo}}</td>
									<td>{{$row->departamento}}</td>
									<td>{{$row->equipo}}</td>
									<td>{{$row->telefono}}</td>
									<td>{{$row->cedula}}</td>
									<td>{{$row->email}}</td>
									<td>
										<a href="{{url('equipos/'.$row->id.'/edit')}}" class='btn btn-warning btn-sm' title='editar'><i class='fa fa-edit'></i></a>
										<button class="btn btn-danger btn-sm eliminar" title="eliminar" data-eliminar='{{$row->id}}'><i class="fa fa-trash"></i></button>
									</td>
								</tr>
							@endforeach
						@else
							<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
						@endif
					</tbody>
				</table>

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