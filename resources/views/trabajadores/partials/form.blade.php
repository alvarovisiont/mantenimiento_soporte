{!! Form::open(['class' => 'form-horizontal', 'url' => $url, 'method' => $method]) !!}
	<div class="form-group">
		{!! Form::label('nombre_completo', 'Nombre Completo',['class' => 'control-label col-md-2']) !!}
		<div class="col-md-3">
			{!! Form::text('nombre_completo', $trabajador->nombre_completo,['class' => 'form-control', 'required', 'placeholder' => "Indique el nombre del trabajador" ]) !!}
				@if($errors->has('nombre'))
					<span class="help-block"><strong>{{$errors->first('nombre')}}</strong></span>
				@endif
		</div>
		{!! Form::label('cedula', 'Cédula',['class' => 'control-label col-md-2']) !!}
		<div class="col-md-3 {{$errors->has('cedula') ? 'has-error' : ''}}">
			{!! Form::text('cedula', $trabajador->cedula,['class' => 'form-control', 'required', 'placeholder' => "Indique la cédula del trabajador" ]) !!}	
				@if($errors->has('cedula'))
					<span class="help-block"><strong>{{$errors->first('cedula')}}</strong></span>
				@endif
		</div>
	</div>	
	<div class="form-group">
		{!! Form::label('telefono', 'Teléfono',['class' => 'control-label col-md-2']) !!}
		<div class="col-md-3 {{$errors->has('telefono') ? 'has-error' : ''}}">
			{!! Form::text('telefono', $trabajador->telefono,['class' => 'form-control', 'required', 'placeholder' => "Indique el teléfono del trabajador" ]) !!}	
			@if($errors->has('telefono'))
				<span class="help-block"><strong>{{$errors->first('telefono')}}</strong></span>
			@endif
		</div>
		{!! Form::label('email', 'Email',['class' => 'control-label col-md-2']) !!}
		<div class="col-md-3 {{$errors->has('email') ? 'has-error' : ''}}">
			{!! Form::text('email', $trabajador->email,['class' => 'form-control', 'required', 'placeholder' => "Indique el email del trabajador" ]) !!}	
			@if($errors->has('email'))
				<span class="help-block"><strong>{{$errors->first('email')}}</strong></span>
			@endif
		</div>
	</div>
	<div class="form-group">
	{!! Form::label('departamento_id', 'Departamento',['class' => 'control-label col-md-2']) !!}
		<div class="col-md-3">
			{!! Form::select('departamento_id', $departamentos ,$trabajador->departamento_id,['class' => 'form-control', 'required']) !!}
		</div>
		{!! Form::label('equipos_id', 'Equipo',['class' => 'control-label col-md-2']) !!}
		<div class="col-md-3">
			{!! Form::select('equipos_id', $equipos ,$trabajador->equipo_id,['class' => 'form-control', 'required']) !!}	
		</div>
	</div>
	<div class="form-group">
		<div class="col-md-3 col-md-offset-1">
			<input type="submit" value="Enviar" class="btn btn-success btn-block">	
		</div>
		<div class="col-md-offset-4 col-md-4">
			<a href="{{url('trabajadores')}}">Regresar al listado de Trabajadores</a>
		</div>
	</div>
{!! Form::close() !!}
