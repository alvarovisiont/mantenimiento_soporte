@extends('layout.admin')

@section('contenido')
	<h1 class="text-center">Reporte de fallas&nbsp;<img src="{{ asset('img/aviso.jpg') }}" alt="" width="70"></h1>
	<hr>
	{!! Form::open(['url' => 'fallas', 'method' => 'POST', 'class' => 'form-horizontal', 'id' => 'form_agregar']) !!}
		{!! Form::hidden('equipos_id', $datos->id_equipo) !!}
		{!! Form::hidden('trabajador_id', $datos->id) !!}
		{!! Form::hidden('departamento_id', $datos->departamento) !!}
		<div class="form-group">
			{!! Form::label('nombre_equipo', 'Nombre Equipo', ['class' => 'control-label col-md-2 col-md-offset-1']) !!}
			<div class="col-md-6">
				{!! Form::text('nombre_equipo',$datos->nom_equipo." - ".$datos->bm, ['class' => 'form-control text-center', 'readonly']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('trabajadores_id', 'Trabajador', ['class' => 'control-label col-md-2 col-md-offset-1']) !!}
			<div class="col-md-6">
				{!! Form::text('trabajadores_id',$datos->nombre_completo,['class' => 'form-control text-center', 'readonly']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('descripcion', 'Descripción de la falla', ['class' => 'control-label col-md-2 col-md-offset-1']) !!}
			<div class="col-md-6">
				{!! Form::textarea('descripcion',null,['rows' => '4', 'class' => 'form-control', 'required']) !!}	
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-6 col-md-offset-3">
				<button class="btn btn-success btn-block">Guardar&nbsp;<i class="fa fa-save"></i></button>
			</div>
		</div>
	</form>
@endsection