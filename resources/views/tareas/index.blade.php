@extends('layout.admin')

@section('contenido')
	<h3 class="text-center">Tareas Asignadas&nbsp;&nbsp;<img src="{{ asset('img/tareas_asignadas1.png')}}" alt="" width="70"></h3>
		<?php
			$x = 0;
		?>
		@if(Session::has('flash_create'))
			<div class="row" id="aviso">
				<div class="col-md-8 col-md-offset-2">
					<div class="alert alert-success">
					 <h5 class="text-center">{{Session::get('flash_create')}}&nbsp;<i class="fa fa-exclamation-circle"></i></h5>
				    </div>
				</div>
			</div>
			 <?php 
			 	$x = 1;
			 ?>
		@endif
	<table class="table table-bordered table-hover" id="tabla">
		<thead>
			<tr>
				<th class="text-center">Trabajador</th>
				<th class="text-center">Equipo</th>
				<th class="text-center">Falla</th>
				<th class="text-center">Fecha reporte de la Falla</th>
				<th class="text-center">Status</th>
				<th>Reporte</th>
				<th>Finalizar</th>
			</tr>
		</thead>
		<tbody class="text-center">
			@foreach($works as $row)
				@if($row->status == 1)
				
					@php 
						$clase = "alert alert-success";
						$status = "Completada";
					@endphp
				
				@elseif($row->status == 0)
				
					@php
						$clase = "alert alert-warning";
						$status = "En espera";
					@endphp
				
				@else
					
					@php
						$clase = "alert alert-danger";
						$status = "Retrasada";
					@endphp
				
				@endif
				<tr class="<?php echo $clase; ?>">
					<td>{{$row->nombre_completo}}</td>
					<td>{{$row->nom_equipo." / ".$row->bm}}</td>
					<td>{{$row->descripcion}}</td>
					<td>
						<?php
							echo date('d-m-Y H:i:s A', strtotime($row->fecha_tarea))
						?>
					</td>
					<td class="status">@php echo $status; @endphp</td>
					<td class="boton_modal">
						@if($row->status != 1)
							<button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#modal_reporte" data-falla = "{{$row->falla_id}}" data-trabajador = "{{$row->trabajadores_id}}" data-soporte = "{{$row->soporte_id}}"><i class="fa fa-pencil"></i></button>
						@endif
					</td>
					<td class="boton_finalizar">
						@if($row->status != 1)
							<button type="button" class="btn btn-danger btn-md finalizar" data-falla = "{{$row->falla_id}}"><i class="fa fa-thumbs-up"></i></button>
						@endif
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal_reporte">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background-color: #E82C0C; color: white;">
				<button type="button" class="close" data-dismiss="modal" arial-label="Close">
					<span aria-hidden="true">x</span>
				</button>
				<h4 class="modal-title">Realizar Reporte</h4>
			</div>
			{!! Form::open(['url' => 'tareas/reportes', 'method' => 'POST', 'class' => 'form-horizontal', 'id' => 'form_reporte', 'files' => true]) !!}
				{!! Form::hidden('falla_id', null, ['id' => 'falla_id']) !!}
				{!! Form::hidden('soporte_id', null, ['id' => 'soporte_id']) !!}
				{!! Form::hidden('trabajador_id', null, ['id' => 'trabajador_id']) !!}

			<div class="modal-body">
				<div class="form-group">
					{!! Form::label('cuerpo_reporte', 'Cuerpo del reporte', ['class' => 'control-label col-md-2 col-md-offset-2']) !!}
					<div class="col-md-7">
						{!! Form::textarea('cuerpo_reporte', null, ['class' => 'form-control', 'required', 'cols' => '10', 'rows' => 3]) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('imagenes', 'Imagenes del Reporte', ['class' => 'control-label col-md-3 col-md-offset-1']) !!}
					<div class="col-md-7">
						{!! Form::file('imagenes[]', ['multiple', 'class' => 'form-control']) !!}
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-7 col-md-offset-3" id="barra_oculta" style="display:none">
						<div class="progress progress-striped active">
							  	<div class="progress-bar" role="progressbar"
							       aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"
							       style="width: 100%">
							       <span>Enviando...</span>
							    	<span class="sr-only">45% completado</span>
							  </div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-success" id="enviar">Guardar</i></button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>
<!-- ======================= Formulario para finalizar la tarea ========================== -->

{!! Form::open(['url' => 'tareas/'.":TAREA", 'method' => 'PATCH', 'id' => 'form_finalizar']) !!}

{!! Form::close() !!}

<!-- ************************************************************************************* -->

@endsection

@section('script')
	<script>
		$(function(){

			var validar = <?php echo $x; ?>;
			if(validar == 1)
			{
				setTimeout(function(){
					$("#aviso").hide('slow');
				},2500);
			}
			
			$("#tabla").dataTable({
				"language" : {"url" : "json/esp.json"}
			});

			$("#modal_reporte").on('show.bs.modal', function(e){
				var x = $(e.relatedTarget).data('trabajador');
						$(e.currentTarget).find('#trabajador_id').val(x);
				var x = $(e.relatedTarget).data('falla');
						$(e.currentTarget).find('#falla_id').val(x);
				var x = $(e.relatedTarget).data('soporte');
						$(e.currentTarget).find('#soporte_id').val(x);

			});

			function pregunta()
			{
				var agree = confirm("¿Esta seguro que desea entregar la tarea?");
				return agree;
			}

			$(".finalizar").click(function(){
				var confirm = pregunta(),
					falla = $(this).data().falla,
					btn = $(this);

				if(confirm)
				{
					var form = $("#form_finalizar"),
						datos = form.serialize();
						ruta = form.attr('action').replace(':TAREA', falla),
						datos = datos + "&falla="+falla;

					$.post(ruta, datos, function(){
						
						btn.hide();

						btn.parent().parent().removeClass('alert-warning').removeClass('alert-danger').addClass('alert-success');
						
						btn.parent().siblings('.boton_modal').empty();

						btn.parent().siblings('.status').empty().text('Completada');
					});
				}
				else
				{
					return confirm;
				}
			});

			$("#form_reporte").submit(function(event) {
				$("#barra_oculta").show('slow/400/fast');
			});
		});
	</script>
@endsection