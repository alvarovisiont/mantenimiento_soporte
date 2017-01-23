

@extends('layout.admin')
@section('contenido')

 <script type="text/javascript">
    $(document).ready(function() {
    $('.table').DataTable();
} );
  </script>


<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover" id="tabla">
				<thead>
					<th>Cedula</th>
					<th>Nombre</th>
					<th>Apellido</th>
					<th>Usuario</th>
					<th>Cargo</th>
					<th>Accion</th>
					
				</thead>
				@foreach($datos as $d)

				@php
	
					if($d->nivel == "1"){
						$d->nivel = "Administrador";
					}
						
					if($d->nivel == "2"){
						$d->nivel = "Trabajador";
					}
						
					if($d->nivel == "3"){
						$d->nivel = "Operador";
					}

				@endphp
				<tbody id="body">
				<tr>
					<td>{{ $d->cedula }}</td>
					<td>{{ $d->name }}</td>
					<td>{{ $d->apellido }}</td>
					<td>{{ $d->usuario }}</td>
					<td>{{ $d->nivel }}</td>
					<td>
						<a href="" data-target="#modal-modificar-{{$d->id_user}}" data-toggle="modal"><button class="btn btn-info">Modificar</button></a>
						<a href="" data-target="#modal-delete-{{$d->id_user}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td>
				</tr>
				</tbody>
				@include('usuarios.modal')
				@endforeach
			</table>
		</div>
	</div>
</div>
@endsection {{-- finaliza contenido --}}