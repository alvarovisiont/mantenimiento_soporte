@extends('layout.admin')
@section('contenido')
	@include('equipos.partials.form',['url' => 'equipos', 'method' => 'POST', 'equipo' => $equipo, 'tipos' => $tipos])
@endsection
