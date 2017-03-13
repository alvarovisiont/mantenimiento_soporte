{!! Form::open(['url' => $url, 'method' => $method, 'class' => 'form-horizontal']) !!}
	<div class="form-group">
		{!! Form::label('soporte', 'Soporte',['class' => 'control-label col-md-2']) !!}
		<div class="col-md-4">
			{!! Form::select('soportes_id', $soportes, $actualizacion->soporte_id,['class' => 'form-control', 'required']) !!}	
		</div>
		{!! Form::label('equipo', 'Equipo',['class' => 'control-label col-md-2']) !!}
		<div class="col-md-4">
			{!! Form::select('equipos_id', $equipos, $actualizacion->equipo_id,['class' => 'form-control', 'required']) !!}	
		</div>
	</div>
	<div class="form-group">
		{!! Form::label('descripcion', 'Actualización',['class' => 'control-label col-md-2']) !!}
		<div class="col-md-4">
			{!! Form::textarea('descripcion', $actualizacion->descripcion,['class' => 'form-control', 'required', 'cols' => '8', 'rows' => '4']) !!}	
		</div>
	</div>
	<div class="form-group">
		<div class="col-md-4 col-md-offset-4">
			<button class="btn btn-success btn-block">Grabar&nbsp;<i class="fa fa-save"></i></button>
		</div>
		<div class="col-md-3 col-md-offset-1">
			<a href="{{ url('actualizar') }}">Regresar al listado de actualizaciones</a>
		</div>
	</div>
{!! Form::close() !!}
