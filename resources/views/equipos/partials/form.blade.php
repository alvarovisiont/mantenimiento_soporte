{!! Form::open(['class' => 'form-horizontal', 'url' => $url, 'method' => $method]) !!}
	<div class="form-group">
		<div class="col-md-12">
			<button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#modal_caracteristicas">Ver características pre-cargadas&nbsp;&nbsp;<i class="fa fa-file-text-o"></i></button>
		</div>
	</div>
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
		<div class="col-md-3 {{$errors->has('monitor') ? 'has-error' : ''}}">
			{!! Form::text('monitor', $equipo->monitor,['class' => 'form-control', 'required', 'placeholder' => "Indique el bm del Monitor" ]) !!}	
			@if($errors->has('monitor'))
					<span class="help-block"><strong>{{$errors->first('monitor')}}</strong></span>
			@endif
		</div>
		{!! Form::label('descripcion_monitor', 'Características del Monitor',['class' => 'control-label col-md-2']) !!}
		<div class="col-md-3">
			{!! Form::textarea('descripcion_monitor', $equipo->descripcion_monitor, ['class' => 'form-control', 'cols' => '8', 'rows' => '3']) !!}
		</div>	
	</div>
	<div class="form-group">
		{!! Form::label('raton', 'Bm del ratón',['class' => 'control-label col-md-2']) !!}
		<div class="col-md-3 {{$errors->has('raton') ? 'has-error' : ''}}">
			{!! Form::text('raton', $equipo->raton,['class' => 'form-control', 'required', 'placeholder' => "Indique el bm del ratón" ]) !!}	
			@if($errors->has('raton'))
				<span class="help-block"><strong>{{$errors->first('raton')}}</strong></span>
			@endif
		</div>
		{!! Form::label('descripcion_raton', 'Características del ratón',['class' => 'control-label col-md-2']) !!}
		<div class="col-md-3">
			{!! Form::textarea('descripcion_raton', $equipo->descripcion_raton, ['class' => 'form-control', 'cols' => '8', 'rows' => '3']) !!}
		</div>	
	</div>
	<div class="form-group">
		{!! Form::label('teclado', 'Bm del teclado',['class' => 'control-label col-md-2']) !!}
		<div class="col-md-3 {{$errors->has('teclado') ? 'has-error' : ''}}">
			{!! Form::text('teclado', $equipo->teclado,['class' => 'form-control', 'required', 'placeholder' => "Indique el bm del teclado" ]) !!}
			@if($errors->has('teclado'))
				<span class="help-block"><strong>{{$errors->first('teclado')}}</strong></span>
			@endif	
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

<div class="modal fade" id="modal_caracteristicas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
	   	<div class="modal-content">
		    <div class="modal-header" style="background-color: #2280E8; color: white;">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		        <h3 class="text-center">Características de los equipos&nbsp;<i class="fa fa-desktop"></i></h3>
		      </div>
		      <div class="modal-body">
		      	<div class="row">
		      		<div class="col-md-12">
		      			<div class="col-md-12" id="barra_oculta" style="display:none">
							<div class="progress progress-striped active">
								  	<div class="progress-bar" role="progressbar"
								       aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"
								       style="width: 100%">
								       <span>Cargando...</span>
								    	<span class="sr-only">45% completado</span>
								  </div>
							</div>
						</div>
		      			<table class="table table-bordered table-hover" id="tabla">
		      				<thead>
		      					<tr>
		      						<th class="text-center">Tipo</th>
		      						<th class="text-center">Características</th>
		      					</tr>
		      				</thead>
		      				<tbody class="text-center">
		      					
		      				</tbody>
		      			</table>
		      		</div>
		      	</div>
		      <div class="modal-footer">
		      	<button class="btn btn-danger" data-dismiss='modal'>Cerrar&nbsp;<i class="fa fa-remove"></i></button>
		      </div>
	    	</div>
		</div>
	</div>
</div>