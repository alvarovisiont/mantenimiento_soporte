@extends('layout.admin')

@section('contenido')
	<div class="row">
		<div class="container-fluid">
			<div class="col-md-12">
				<table class="table table-bordered table-hover">
					<thead>
						<tr>
							<th class="text-center">Nombre_Completo</th>
							<th class="text-center">Cédula</th>
							<th class="text-center">Nº de Tareas</th>
							<th class="text-center">Nº de Actualizaciones</th>
						</tr>
					</thead>
					<tbody class="text-center">
						@foreach($datos as $row)
							<tr>
								<td>{{$row->nombre_completo}}</td>
								<td>{{$row->cedula}}</td>
								<td></td>
								<td></td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection