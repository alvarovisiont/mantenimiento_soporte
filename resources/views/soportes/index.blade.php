@extends('layout.admin')

@section('contenido')
	<div class="row">
		<div class="container-fluid">
			<div class="col-md-12">

			@if(Session::has('flash_message'))
				<div class="row">
					<div class="col-md-8 col-md-offset-2">
						<div class="alert alert-success alert-dismissable">
						 <button type="button" class="close" data-dismiss="alert">&times;</button>
						 <h4 class="text-center">{{Session::get('flash_message')}}</h4>
					    </div>
					</div>
				 </div>
			@endif
			

			<a class="btn btn-success pull-right" href="{{url('soportes/create')}}"><i class="fa fa-user-plus" aria-hidden="true"></i> Agregar Soporte</a>
				<table class="table table-bordered table-hover">
					<thead>
						<tr>
							<th class="text-center">Nombre_Completo</th>
							<th class="text-center">Cédula</th>
							<th class="text-center">Nº de Tareas</th>
							<th class="text-center">Nº de Actualizaciones</th>
							<th>Accion</th>
						</tr>
					</thead>
					<tbody class="text-center">
						@foreach($datos as $row)
							<tr>
								<td>{{$row->nombre_completo}}</td>
								<td>{{$row->cedula}}</td>
								<td></td>
								<td></td>
								<td>
									<a href="" data-target="#modal-modificar-{{$row->id}}" data-toggle="modal"><button class="btn btn-info">Modificar</button></a>
									<a href="" data-target="#modal-eliminar-{{$row->id}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
								</td>
							</tr>
							@include('soportes.modal')
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection