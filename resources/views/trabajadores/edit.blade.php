@extends('layout.admin')

@section('contenido')
	@include('trabajadores.partials.form',['url' => 'trabajadores/'.$trabajador->id, 'method' => 'PATCH', 'trabajador' => $trabajador, 'departamentos' => $departamentos, 'equipos' => $equipos])
@endsection