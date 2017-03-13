@extends('layout.admin')
@section('contenido')
	<div class="row">
		<div class="container">
			<div class="col-md-12">
				<h2>Editar Departamento: <span>{{$departamentos->nombre}}</span></h2>
				@include('departamentos.partials.form', ['departamentos' => $departamentos,'url' => 'departamentos/'.$departamentos->id, 'method' => "PATCH"])		
			</div>
		</div>
	</div>
@endsection