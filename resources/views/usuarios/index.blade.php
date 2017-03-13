@extends('layout.admin')
@section('contenido')

		<?php
			$x = 0;
		?>
		@if(Session::has('flash_create'))
			<div class="row">
				<div class="col-md-8 col-md-offset-2 ">
					<div class="alert alert-success">
					 <h5 class="text-center">{{Session::get('flash_create')}}&nbsp;<i class="fa fa-exclamation-circle"></i></h5>
				    </div>
				</div>
			</div>
			 <?php 
			 	$x = 1;
			 ?>
		@endif
		<div class="row">
			<div class="col-md-8 col-md-offset-2 text-center">
				<div class="alert alert-success" id="aviso" style="display: none;">
				 <h5 class="">&nbsp;<i class="fa fa-exclamation-circle"></i></h5>
			    </div>
			</div>
		</div>
		<div class="form-group">
			<a href="{{url('usuarios/create')}}" class="btn btn-primary btn-block btn-md">Agregar Usuario&nbsp;&nbsp;<i class="fa fa-users"></i></a>
		</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-bordered table-hover" id="tabla">
				<thead>
					<th class="text-center">Trabajador</th>
					<th class="text-center">Soporte</th>
					<th class="text-center">Usuario</th>
					<th class="text-center">Cargo</th>
					<th class="text-center">Accion</th>
				</thead>
				@foreach($datos as $d)

				@php
					$nivel = "";
					$nombre_trabajador = "";
					$nombre_soporte = "";
					
					if($d->nivel == "1"){
						$nivel = "Administrador";
					}
						
					if($d->nivel == "2"){
						$nivel = "Soporte";
						$nombre = $d->nombre_soporte;

					}
						
					if($d->nivel == "3"){
						$nivel = "Trabajador";
						$nombre = $d->nombre_completo;
					}

					if($d->tipo == 1)
					{
						$nombre_trabajador = $d->nombre_completo;
					}
					elseif($d->tipo == 2)
					{
						$nombre_soporte = $d->nombre_soporte;
					}

				@endphp
				<tbody id="body" class="text-center">
				<tr>
					<td>@php echo $nombre_trabajador; @endphp</td>
					<td>@php echo $nombre_soporte; @endphp</td>
					<td>{{ $d->usuario }}</td>
					<td>@php echo $nivel; @endphp</td>
					<td>
						<a href="" data-target="#modal-modificar-{{$d->id_user}}" data-toggle="modal"><button class="btn btn-info">Modificar</button></a>
						@if($d->id_user != Auth::user()->id_user)
							<button type="button" data-id = "{{$d->id_user}}" class="btn btn-danger eliminar">Eliminar</button>
						@else
							<button type="button" data-id = "{{$d->id_user}}" class="btn btn-danger eliminar" disabled="">Eliminar</button>
						@endif
					</td>
				</tr>
				</tbody>
				@include('usuarios.modal')
				@endforeach
			</table>
		</div>
	</div>
</div>

{!! Form::open(['url' => 'usuarios/'.':USER', 'class' => 'formulario_eliminar', 'style' => 'display: inline-block', 'method' => 'DELETE']) !!}
{!! Form::close() !!}

@endsection {{-- finaliza contenido --}}

@section('script')
    <script>
        $(function()
        {
            $("#tabla").dataTable({
                "language" : {"url" : "json/esp.json"}
            });

            var validacion = <?php echo $x; ?>; 
			if(validacion == 1)
			{
				setTimeout(function(){
					$(".alert-success").hide('slow/400/fast');
				}, 2500);
				
			}

			function pregunta()
			{
				var agree = confirm("¿Esta seguro de querer borrar realmente este registro?");
				return agree;
			}

			$(".eliminar").click(function(e){

				var confirm = pregunta();
				
				if(confirm)
				{
					$("#barra_oculta").show('slow/400/fast');
					var tr = $(this).parent().parent();
					var form = $(".formulario_eliminar");
					var id = $(this).data('id');
					var ruta = form.attr('action').replace(':USER', id);
					var data = form.serialize();

					$.ajax({
						url: ruta,
						type:'POST',
						data: data,
					})
					.done(function(){
						$("#barra_oculta").hide('slow/400/fast');
						tr.remove();
						$("#aviso").removeClass('alert-danger').addClass('alert-success').empty().html('Usuario eliminado con éxito&nbsp;<i class="fa fa-exclamation-circle"></i>').show('slow/400/fast');
						setTimeout(function(){
							$("#aviso").hide('slow/400/fast');
						},2500);	
					});
				}
				else
				{
					return confirm;	
				}
			});
        });
    </script>
@endsection