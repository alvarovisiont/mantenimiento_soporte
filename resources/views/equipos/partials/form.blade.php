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
		{!! Form::label('descripcion', 'Descripcion del equipo',['class' => 'control-label col-md-2']) !!}
		<div class="col-md-3">
			{!! Form::textarea('descripcion', $equipo->descripcion,['class' => 'form-control', 'required', 'placeholder' => "Indique la descripción del equipo", 'rows' => '5', 'cols' => '3' ]) !!}	
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
