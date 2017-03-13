@extends('layout.admin')

@section('contenido')
	
	@include('actualizacion.partials.form', ['soportes' => $soportes, 'equipos' => $equipos, 'actualizacion' => $actualizacion, 'url' => 'actualizar', 'method' => "POST"])
	
@endsection