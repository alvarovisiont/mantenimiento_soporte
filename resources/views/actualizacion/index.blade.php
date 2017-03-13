@extends('layout.admin')

@section('contenido')

		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="alert alert-success" id="aviso" style="display: none;">
				 <h5 class="text-center">Actualización eliminada con éxito&nbsp;<i class="fa fa-exclamation-circle"></i></h5>
			    </div>
			</div>
		</div>
		<?php
			$x = 0;
		?>
		@if(Session::has('flash_create'))
			<div class="row">
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
		<div class="form-group">
			<a href="{{ url('actualizar/create') }}" class="btn btn-danger btn-block">Registrar Actualización <i class="fa fa-upload" aria-hidden="true"></i></a>
		</div>
		<table class="table table-bordered table-hover" id="tabla">
			<thead>
				<th class="text-center">Bien Mueble</th>
				<th class="text-center">Soporte</th>
				<th class="text-center">Descripcion</th>
				<th class="text-center">Fecha Registro</th>
				<th class="text-center">Acción</th>
			</thead>
			<tbody class="text-center">
				@foreach($datos as $row)
					<?php
						$detalles = "<button class='btn btn-info btn-sm' data-toggle='modal' data-target='#modal_descripcion'
							data-descripcion='$row->descripcion'>Ver&nbsp;<i class='fa fa-search'></i></button>";
					?>
					<tr>
						<td>{{ strtoupper($row->bm)}}</td>
						<td>{{$row->nombre_completo}}</td>
						<td><?php echo $detalles ?></td>
						<td><?php echo  date('d-m-Y H:i:s A', strtotime($row->created_at)); ?></td>
						<td>
							<a href='{{url('actualizar/'.$row->id.'/edit')}}' class='btn btn-warning btn-sm' title='editar'><i class='fa fa-edit'></i></a>
							<button class='btn btn-danger btn-sm eliminar' title='Eliminar' data-id="{{$row->id}}"><i class='fa fa-trash'></i></button>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
		<div class="modal fade" id="modal_descripcion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	        <div class="modal-dialog" role="document">
	          <div class="modal-content">
	            <div class="modal-header" style="background-color: #2280E8; color: white;">
	              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                <span aria-hidden="true">&times;</span>
	              </button>
	              <h3 class="text-center">Descripción de la actualización</span></h3>
	            </div>
	            <div class="modal-body">
	              <div class="row">
	                <div class="col-md-12">
	                	<p id="parrafo_descripcion"></p>
	                </div>
	              </div>
	            </div>
	            <div class="modal-footer">
	              <button class="btn btn-danger" data-dismiss='modal'>Cerrar&nbsp;<i class="fa fa-remove"></i></button>
	            </div>
	          </div>
	      </div>
	    </div>
    {!! Form::open(['url' => 'actualizar/'.':USER', 'class' => 'formulario_eliminar', 'style' => 'display: inline-block', 'method' => 'DELETE']) !!}
	{!! Form::close() !!}

@endsection

@section('script')
	<script>
		$(document).ready(function(){
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

			$("#modal_descripcion").on('show.bs.modal', function(e){
				var x = $(e.relatedTarget).data().descripcion;
						$("#parrafo_descripcion").empty().html(x);
			});

			function pregunta()
			{
				var agree = confirm("¿Desea realmente eliminar este registro?");
				return agree;
			}

			$(".eliminar").on('click', function(e) {
				
				var confirm = pregunta();
				if(confirm)
				{
					var btn = $(this);
					var id = $(this).data('id');
					var ruta = $(".formulario_eliminar").attr('action').replace(":USER", id);
					var datos = $(".formulario_eliminar").serialize();
							
					$.post(ruta,datos, function(){
						btn.parent().parent().remove();

						$("#aviso").show('slow/400/fast', function(){
							setTimeout(function(){
								$("#aviso").hide('slow/400/fast');
							},2500);
						});
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