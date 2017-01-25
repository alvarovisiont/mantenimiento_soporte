<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-modificar-{{$row->id}}">
	
{{Form::Open(array('action'=>array('SoportesController@update',$row->id), 'method' =>'PATCH','id' =>'form'))}}
{{--<input type="hidden" name="_token" value="{{ csrf_token }}" id="token">--}}
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" arial-label="Close">
				<span aria-hidden="true">x</span>
			</button>
			<h4 class="modal-title">Editar {{$row->nombre_completo}}</h4>
		</div>
		<div class="modal-body">
			{!! Form::model($row,['method'=>'PATCH', 'route'=>['soportes.update',$row->id]]) !!}
		{{ Form::token() }}
 	
<div class="container">
	<div class="row">
		<div class="col-md-4">
					<div class="form-group {{ $errors->has('cedula') ? ' has-error' : '' }}">
						<label for="cedula">Cedula</label>
						<input type="text" name="cedula"  value="{{$row->cedula}}" class="form-control" placeholder="Cedula">
						 @if ($errors->has('cedula'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('cedula') }}</strong>
                                  </span>
                            @endif
					</div>
				</div>
				</div>
				<div class="row">
			<div class="col-md-4">
				<div class="form-group {{ $errors->has('nombre_completo') ? ' has-error ' : '' }}">
					<label for="nombre">Nombre completo</label>
					<input type="text" name="nombre_completo"  value="{{$row->nombre_completo}}" class="form-control" placeholder="Nombre completo">
					@if ($errors->has('nombre_completo'))
						<span class="help-block">
							<strong>{{ $errors->first('nombre_completo') }}</strong>
						</span>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
		
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			<button type="submit" class="btn btn-info" id="enviar">Modificar</button>
		</div>
	</div>
</div>
{!! Form::close() !!}
</div>



