@extends('layout.admin')

@section('contenido')
	@include('trabajadores.partials.form',['url' => 'trabajadores', 'method' => 'POST', 'trabajador' => $trabajador, 'departamentos' => $departamentos, 'equipos' => $equipos])
@endsection
