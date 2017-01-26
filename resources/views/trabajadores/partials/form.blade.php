{!! Form::open(['class' => 'form-horizontal', 'url' => $url, 'method' => $method]) !!}

	<div class="form-group">
		<div class="col-md-7 col-md-offset-1">
			{!! Form::text('nombre', $departamentos->nombre,['class' => 'form-control', 'required', 'placeholder' => "Indique el nombre del departamento" ]) !!}	
		</div>
	</div>	
	<div class="form-group">
		<div class="col-md-7 col-md-offset-1">
			{!! Form::text('descripcion', $departamentos->descripcion,['class' => 'form-control', 'required', 'placeholder' => "Indique la descripción del departamento" ]) !!}	
		</div>
	</div>	
	<div class="form-group">
		<div class="col-md-3 col-md-offset-1">
			<input type="submit" value="Enviar" class="btn btn-success btn-block">	
		</div>
		<div class="col-md-offset-4 col-md-4">
			<a href="{{url('departamentos')}}">Regresar al listado de Departamentos</a>
		</div>
	</div>
{!! Form::close() !!}