@extends('layout.admin')
@section('contenido')
	<div class="row">
		<div class="container-fluid">
			<div class="col-md-12">
				<h1>Departamentos</h1>
				<br><br>
				<div class="form-group">
					<table class="table table-striped table-hover">
						<thead>
							<th class="text-center">Nombre</th>
							<th class="text-center">Descripción</th>
							<th></th>
						</thead>
						<tbody class="text-center">
							@foreach($datos as $row)
								<?php
									$botones = "<button class='btn btn-warning btn-md' data-toggle='modal' data-target='#modal_modificar' 
										data-id_modi= '{$row->id_departamento}'
										data-nombre_modi= '{$row->nombre}'
										data-descrip_modi= '{$row->descripcion}'
									>Modificar&nbsp;<i class='fa fa-edit'></i></button>
									<button class='btn btn-danger btn-md eliminar' title='eliminar'
										data-eliminar= '{$row->id_departamento}'
									>Eliminar&nbsp;<i class='fa fa-trash'></i></button>";
								?>
								<tr>
									<td>{{$row->nombre}}</td>
									<td>{{$row->descripcion}}</td>
									<td><?php echo $botones; ?></td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				<div class="modal fade" id="modal_modificar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				  	<div class="modal-dialog tabla_modal" role="document">
				    	<div class="modal-content">
					      <div class="modal-header modal-header2" style="background-color: #FFF">
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					          <span aria-hidden="true">&times;</span>
					        </button>
					        <h3 class="text-center">Departamento Modificar&nbsp;<i class="fa fa-home"></i>&nbsp;<i class="fa fa-edit"></i></h3>
					      </div>
					      {!! Form::open(['url' => 'departamentos', 'method' => 'PUT' , 'class' => 'form-horizontal']) !!}
					      <div class="modal-body">
					      	<div class="row">
					      		<input type="hidden" id="id_modi" name="id_modi">
					      		<input type="hidden" value="{{Form::token()}}">
					      			<div class="form-group">
					      				{!! Form::label('nombre', 'Nombre Departamento', ['class' => 'control-label col-md-3']) !!}
					      				<div class="col-md-7">
					      					{!! Form::text('nombre', null, ['class' => 'form-control', 'required']) !!}
					      				</div>
					      			</div>
					      			<div class="form-group">
					      				{!! Form::label('descripcion', 'Descripcion', ['class' => 'control-label col-md-3']) !!}
					      				<div class="col-md-7">
					      					{!! Form::text('descripcion', null, ['class' => 'form-control', 'required']) !!}
					      				</div>
					      			</div>
					      	</div>	
					      </div>
					      <div class="modal-footer">
					      	<button class="btn btn-primary btn-md" type="submit" id="">Modificar&nbsp;<i class="fa fa-thumbs-up"></i></button>
					      	<button class="btn btn-danger btn-md" type="button" data-dismiss="modal">cerrar&nbsp;<i class="fa fa-remove"></i></button>
					      </div>
					      {!! form:: close() !!}
				    	</div>
					</div>
				</div>

			</div>
		</div>
	</div>
	<script>
		$(function(){
			$("#modal_modificar").on('show.bs.modal', function(e){
				var x = $(e.relatedTarget).data().id_modi;
						$(e.currentTarget).find("#id_modi").val(x);
				var x = $(e.relatedTarget).data().nombre_modi;
						$(e.currentTarget).find("#nombre").val(x);
				var x = $(e.relatedTarget).data().descrip_modi;
						$(e.currentTarget).find("#descripcion").val(x);
			});

			function pregunta()
			{
				var agree = confirm("Esta seguro de querer eliminar este registro?");
				return agree;
			}

			$(".eliminar").click(function(event) {
				var confirm = pregunta();
				if(confirm)
				{
					var id = $(this).data('eliminar');
					alert(id);
				}
				else
				{
					return false;
				}
			});
		});
	</script>
@endsection