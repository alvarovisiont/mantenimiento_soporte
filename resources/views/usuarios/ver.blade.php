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
					<th>Accion</th>
					
				</thead>
				@foreach($datos as $d)
				<tbody id="body">
				<tr>
					<td>{{ $d->cedula }}</td>
					<td>{{ $d->name }}</td>
					<td>{{ $d->apellido }}</td>
					<td>{{ $d->usuario }}</td>
					<td>
						<a href=""><button class="btn btn-info">Editar</button></a>
						<a href=""><button class="btn btn-success">Ver</button></a>
					</td>
				</tr>
				</tbody>
				@endforeach
			</table>
		</div>
	</div>
</div>
@endsection {{-- finaliza contenido --}}