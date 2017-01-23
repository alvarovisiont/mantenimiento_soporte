@extends('layout.admin')
@section('contenido')
	<h1>Crear Departamento</h1>
	<br>
	@include('departamentos.partials.form', ['url' => 'departamentos', 'method' => 'POST', 'departamentos' => $departamentos])
@endsection