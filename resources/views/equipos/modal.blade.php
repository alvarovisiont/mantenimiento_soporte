{{-- Modal de VER equipo --}}
<div class="row">

</div>
{{--Fin modal ver equipo --}}


{{--Modal para agregar actualizacion--}}
<div class="row">
<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-actualizar">
	
{{Form::Open(array('action'=>array('ActualizacionController@store'), 'method' =>'POST','id' =>'form'))}}
{{--<input type="hidden" name="_token" value="{{ csrf_token }}" id="token">--}}
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" arial-label="Close">
				<span aria-hidden="true">x</span>
			</button>
			<h3 class="text-center">Actualizar equipo</h3>
		
		</div>
		<div class="modal-body">
			{!! Form::model($soporte,['method'=>'POST', 'route'=>['actualizar.store']]) !!}
 				{{ Form::token() }}

				<div class="form-group">
					<label for="nombre">Nombre &nbsp;</label>
					<select class="form-control selector" name="equipos_id" style="width: 80% important!">
					@foreach($datos as $e)
						<option value="{{$e->id}}">{{ strtoupper($e->bm) }} - {{ $e->nom_equipo }}</option>
					@endforeach
					</select>
				</div>
				<br>
				
					<div class="form-group">
						<label for="soporte">Soporte &nbsp;</label>
						<select  class="form-control selector" name="soportes_id" style="width: 80% important!">
						@foreach($soporte as $s)
							<option value="{{$s->id}}">{{$s->nombre_completo}}</option>
						@endforeach
						</select>
					</div>

					<div class="form-group">
						<label class="control-label">Descripcion</label>
						<textarea class="form-control" name="descripcion" rows="4" required></textarea>
					</div>
					
		
			</div>


		
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			<button type="submit" class="btn btn-info" id="enviar">Actualizar</button>
		</div>
	</div>
</div>
{!! Form::close() !!}
</div>
</div>
{{--fin modal de actualizacion--}}

<script type="text/javascript">
	$(".selector").select2();
</script>