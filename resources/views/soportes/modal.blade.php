<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-modificar-{{$row->id}}">
	
{{Form::Open(array('action'=>array('SoportesController@update',$row->id), 'method' =>'PATCH','id' =>'form'))}}
{{--<input type="hidden" name="_token" value="{{ csrf_token }}" id="token">--}}
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background-color: #2280E8; color: white;">
				<button type="button" class="close" data-dismiss="modal" arial-label="Close">
					<span aria-hidden="true">x</span>
				</button>
				<h4 class="modal-title text-center">Editar a  {{$row->nombre_completo}}&nbsp;<i class="fa fa-user"></i></h4>
			</div>
			<div class="modal-body">
				{!! Form::model($row,['method'=>'PATCH', 'route'=>['soportes.update',$row->id]]) !!}
				{{ Form::token() }}
	 	
				<div class="row">
					<div class="form-group">
						<label for="cedula" class="control-label col-md-1 col-md-offset-1">Cedula</label>
						<div class="col-md-4 {{ $errors->has('cedula') ? ' has-error' : '' }}">
							<input type="text" name="cedula"  value="{{$row->cedula}}" class="form-control" placeholder="Cedula">
							 @if ($errors->has('cedula'))
			                    <span class="help-block">
			                        <strong>{{ $errors->first('cedula') }}</strong>
			                    </span>
			                @endif
						</div>
						<label for="nombre" class="control-label col-md-2">Nombre completo</label>
						<div class="col-md-4 {{ $errors->has('nombre_completo') ? ' has-error ' : '' }}">
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
			<div class="modal-footer">
				<button type="submit" class="btn btn-danger" id="enviar">Modificar</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
{!! Form::close() !!}
</div>