@extends('layout.admin')
@section('contenido')
	@include('equipos.partials.form',['url' => 'equipos'.$equipo->id, 'method' => 'PATCH', 'equipo' => $equipo])
@endsection