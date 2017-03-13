{!! Form::open(['class' => 'form-horizontal', 'url' => $url, 'method' => $method]) !!}
	<div class="form-group">
		{!! Form::label('bm', 'Bien Mueble',['class' => 'control-label col-md-2']) !!}
		<div class="col-md-3 {{$errors->has('bm') ? 'has-error' : ''}}">
			{!! Form::text('bm', $equipo->bm,['class' => 'form-control', 'required', 'placeholder' => "Indique el nombre del Bien Mueble" ]) !!}
				@if($errors->has('bm'))
					<span class="help-block"><strong>{{$errors->first('bm')}}</strong></span>
				@endif
		</div>
		{!! Form::label('nom_equipo', 'Nombre del Equipo',['class' => 'control-label col-md-2']) !!}
		<div class="col-md-3 {{$errors->has('nom_equipo') ? 'has-error' : ''}}">
			{!! Form::text('nom_equipo', $equipo->nom_equipo,['class' => 'form-control', 'required', 'placeholder' => "Indique el nombre del equipo" ]) !!}	
				@if($errors->has('nom_equipo'))
					<span class="help-block"><strong>{{$errors->first('nom_equipo')}}</strong></span>
				@endif
		</div>
	</div>	
	<div class="form-group">
		{!! Form::label('ip', 'Ip del equipo',['class' => 'control-label col-md-2']) !!}
		<div class="col-md-3 {{$errors->has('ip') ? 'has-error' : ''}}">
			{!! Form::text('ip', $equipo->ip,['class' => 'form-control', 'required', 'placeholder' => "Indique el ip del equipo" ]) !!}	
			@if($errors->has('ip'))
				<span class="help-block"><strong>{{$errors->first('ip')}}</strong></span>
			@endif
		</div>
		{!! Form::label('tipo', 'Características del equipo',['class' => 'control-label col-md-2', 'style' => 'display']) !!}
		<div class="col-md-3">
			{!! Form::select('tipo',[null => 'Escoja el tipo de equipo'] + $tipos, $equipo->tipo,['class' => 'form-control', 'required']) !!}	
		</div>
	</div>
	<div class="form-group">
		<label for="" class="control-label col-md-2 col-md-offset-2">¿Posee Otras Características?</label>
		<div class="col-md-2">
			<input type="checkbox" id="otras_caracterisitcas">
		</div>
		<div class="col-md-6" id="div_oculto" style='display: none'>
			{!! Form::label('caracteristicas_extras', 'Específique', ['class' => 'control-label col-md-2']) !!}
			<div class="col-md-6">
				{!! Form::textarea('caracteristicas_extras', $equipo->caracteristicas_extras, ['class' => 'form-control', 'cols' => '8', 'rows' => '3']) !!}
			</div>
		</div>
	</div>
	<div class="form-group">
		{!! Form::label('monitor', 'Bm del Monitor',['class' => 'control-label col-md-2']) !!}
		<div class="col-md-3">
			{!! Form::text('monitor', $equipo->monitor,['class' => 'form-control', 'required', 'placeholder' => "Indique el bm del Monitor" ]) !!}	
		</div>
		{!! Form::label('descripcion_monitor', 'Características del Monitor',['class' => 'control-label col-md-2']) !!}
		<div class="col-md-3">
			{!! Form::textarea('descripcion_monitor', $equipo->descripcion_monitor, ['class' => 'form-control', 'cols' => '8', 'rows' => '3']) !!}
		</div>	
	</div>
	<div class="form-group">
		{!! Form::label('raton', 'Bm del ratón',['class' => 'control-label col-md-2']) !!}
		<div class="col-md-3">
			{!! Form::text('raton', $equipo->raton,['class' => 'form-control', 'required', 'placeholder' => "Indique el bm del ratón" ]) !!}	
		</div>
		{!! Form::label('descripcion_raton', 'Características del ratón',['class' => 'control-label col-md-2']) !!}
		<div class="col-md-3">
			{!! Form::textarea('descripcion_raton', $equipo->descripcion_raton, ['class' => 'form-control', 'cols' => '8', 'rows' => '3']) !!}
		</div>	
	</div>
	<div class="form-group">
		{!! Form::label('teclado', 'Bm del teclado',['class' => 'control-label col-md-2']) !!}
		<div class="col-md-3">
			{!! Form::text('teclado', $equipo->teclado,['class' => 'form-control', 'required', 'placeholder' => "Indique el bm del teclado" ]) !!}	
		</div>
		{!! Form::label('descripcion_teclado', 'Características del teclado',['class' => 'control-label col-md-2']) !!}
		<div class="col-md-3">
			{!! Form::textarea('descripcion_teclado', $equipo->descripcion_teclado, ['class' => 'form-control', 'cols' => '8', 'rows' => '3']) !!}
		</div>	
	</div>
	<div class="form-group">
		{!! Form::label('color', 'Color del CPU',['class' => 'control-label col-md-2']) !!}
		<div class="col-md-3">
			{!! Form::select('color',['' => 'Escoja el color del CPU'] + ['Negro' => 'Negro','Gris' => 'Gris', 'Blanco' => 'Blanco', 'Verde' => 'Verde', 'Rojo' => 'Rojo', 'Naranja' => 'Naranaja', 'Rosado' => 'Rosado'], $equipo->color,['class' => 'form-control', 'required']) !!}
		</div>
		{!! Form::label('status', 'Status del CPU',['class' => 'control-label col-md-2']) !!}
		<div class="col-md-3">
			{!! Form::select('status',['0' => 'Disponible','1' => 'En uso', '2' => 'Dañado', '3' => 'Extraviado'], $equipo->status,['class' => 'form-control', 'required']) !!}
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
