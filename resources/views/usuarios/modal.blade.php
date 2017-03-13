<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-modificar-{{$d->id_user}}">
{{Form::Open(array('action'=>array('UsuariosController@update',$d->id_user), 'method' =>'PATCH','id' =>'form'))}}
{{--<input type="hidden" name="_token" value="{{ csrf_token }}" id="token">--}}
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" arial-label="Close">
				<span aria-hidden="true">x</span>
			</button>
			<h4 class="modal-title">Editar {{$d->usuario}}</h4>
		</div>
		{!! Form::model($d,['method'=>'PATCH', 'route'=>['usuarios.update',$d->id_user]]) !!}
			{{ Form::token() }}
		<div class="modal-body">
			<div class="row">
				<div class="form-group">
					<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
						<div class="form-group">
							<label for="usuario">Usuario</label>
							<input type="text" name="usuario" required value="{{$d->usuario}}" class="form-control">
						</div>
					</div>
					<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
						<div class="form-group">
							<label>Nivel</label>

							{!! Form::select('nivel', ['1' => "Administrador", "2" => "Soporte", '3' => "Trabajador"], $d->nivel,['class' => 'form-control', 'required']) !!}
						</div>
					</div>			
				</div>
				<div class="form-group">
					<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
						<div class="form-group">
							<label for="password">Password</label>
							<input type="text" name="password" required value="{{$d->password}}" class="form-control">
						</div>
					</div>
				</div>				
			</div>		
		</div>
		<div class="modal-footer">
			<button type="submit" class="btn btn-info" id="enviar">Modificar</button>
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
		</div>
	</div>
</div>
{!! Form::close() !!}
</div>

<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete-{{$d->id_user}}">