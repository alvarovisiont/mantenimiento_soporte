@php
	
if($d->nivel == "1"){
	$d->nivel = "Administrador";
}
	
if($d->nivel == "2"){
	$d->nivel = "Trabajador";
}
	
if($d->nivel == "3"){
	$d->nivel = "Operador";
}

@endphp

<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete-{{$d->id_user}}">
	
{{Form::Open(array('action'=>array('UsuariosController@update',$d->id_user), 'method' =>'PATCH','id' =>'form'))}}
{{--<input type="hidden" name="_token" value="{{ csrf_token }}" id="token">--}}
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" arial-label="Close">
				<span aria-hidden="true">x</span>
			</button>
			<h4 class="modal-title">Editar {{$d->name}} {{$d->apellido}}</h4>
		</div>
		<div class="modal-body">
			{!! Form::model($d,['method'=>'PATCH', 'route'=>['usuarios.update',$d->id_user]]) !!}
		{{ Form::token() }}
 	
		<div class="row">
			<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
				<div class="form-group">
					<label for="nombre">Nombre</label>
					<input type="text" name="name" required value="{{$d->name}}" class="form-control">
				</div>
			</div>

			<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
				<div class="form-group">
					<label for="apellido">Apellido</label>
					<input type="text" name="apellido" required value="{{$d->apellido}}" class="form-control">
				</div>
			</div>

			<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
				<div class="form-group">
					<label for="usuario">Usuario</label>
					<input type="text" name="usuario" required value="{{$d->apellido}}" class="form-control">
				</div>
			</div>
			<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
				<div class="form-group">
					<label>Nivel</label>
					<select name="nivel" class="form-control">
							<option value={{$d->nivel}} selected>{{$d->nivel}}</option>
							<option value="{{$d->nivel}}" selected="">{{$d->nivel}}</option>
							<option value="{{$d->nivel}}" selected>{{$d->nivel}}</option>
					</select>
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