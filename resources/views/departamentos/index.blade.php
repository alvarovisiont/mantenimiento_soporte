@extends('layout.admin')
@section('contenido')
	<div class="row">
		<div class="container-fluid">
			<div class="col-md-12">
				<div class="jumbotron">
					<div class="form-group">
						<h1 style="display:inline-block">Departamentos</h1>
						<a href="{{url('departamentos/create')}}" class="btn btn-success btn-lg pull-right">Registrar Departamento</a>	
					</div>
				</div>
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
								?>
								<tr>
									<td>{{$row->nombre}}</td>
									<td>{{$row->descripcion}}</td>
									<td>
										<a href="{{url('departamentos/'.$row->id_departamento.'/edit')}}"">Editar</a>
										@include('departamentos.eliminar', ['id' => $row->id_departamento])
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<script>
		$(function(){
			//$("table").dataTable();
			function pregunta()
			{
				var agree = confirm("Esta seguro de querer eliminar este registro?");
				return agree;
			}

			$(".eliminar").click(function(event) {
				var confirm = pregunta();
				if(confirm)
				{
					return true;
				}
				else
				{
					return false;
				}
			});
		});
	</script>
@endsection