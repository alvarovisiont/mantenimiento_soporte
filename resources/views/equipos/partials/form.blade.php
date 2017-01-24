{!! Form::open(['class' => 'form-horizontal', 'url' => $url, 'method' => $method]) !!}
	<div class="form-group">
		{!! Form::label('bm', 'Bien Mueble',['class' => 'control-label col-md-2']) !!}
		<div class="col-md-3">
			{!! Form::text('bm', $equipo->bm,['class' => 'form-control', 'required', 'placeholder' => "Indique el nombre del Bien Mueble" ]) !!}	
		</div>
		{!! Form::label('nom_equipo', 'Nombre del Equipo',['class' => 'control-label col-md-2']) !!}
		<div class="col-md-3">
			{!! Form::text('nom_equipo', $equipo->nom_equipo,['class' => 'form-control', 'required', 'placeholder' => "Indique el nombre del equipo" ]) !!}	
		</div>
	</div>	
	<div class="form-group">
		{!! Form::label('ip', 'Ip del equipo',['class' => 'control-label col-md-2']) !!}
		<div class="col-md-3">
			{!! Form::text('ip', $equipo->ip,['class' => 'form-control', 'required', 'placeholder' => "Indique el ip del equipo" ]) !!}	
		</div>
		{!! Form::label('descripcion', 'Descripcion del equipo',['class' => 'control-label col-md-2']) !!}
		<div class="col-md-3">
			{!! Form::text('descripcion', $equipo->descripcion,['class' => 'form-control', 'required', 'placeholder' => "Indique la descripción del equipo" ]) !!}	
		</div>
	</div>
	<div class="form-group">
		<div class="col-md-3 col-md-offset-1">
			<input type="submit" value="Enviar" class="btn btn-success btn-block">	
		</div>
		<div class="col-md-offset-4 col-md-4">
			<a href="{{url('equipos')}}">Regresar al listado de Equipos</a>
		</div>
	</div>
{!! Form::close() !!}