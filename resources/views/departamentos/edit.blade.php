@extends('layout.admin')
@section('contenido')
	<div class="row">
		<div class="container">
			<div class="col-md-12">
				<h1>Editar Departamento: <span style="text-decoration: underline; color: red">{{$departamentos->nombre}}</span></h1>
				@include('departamentos.partials.form', ['departamentos' => $departamentos,'url' => 'departamentos/'.$departamentos->id_departamento, 'method' => "PATCH"])		
			</div>
		</div>
	</div>
@endsection