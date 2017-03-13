@extends('layout.admin')

@section('section')
	<h2 class="text-center">Tareas Asignadas&nbsp;&nbsp;<img src="{{ asset('img/listas.jpg')}}" alt="" width="70"></h1>
	<table class="table table-bordered table-hover" id="tabla_fallas">
		<thead>
			<tr>
				<th class="text-center">Trabajador</th>
				<th class="text-center">Equipo</th>
				<th class="text-center">Descripción</th>
				<th class="text-center">Fecha Reporte</th>
				<th class="text-center">Status</th>
				<th class="text-center">Culminar</th>
			</tr>
		</thead>
		<tbody class="text-center">
			@foreach($datos as $row)

				@if($row->status == 1)
				{
					<?php 
						$clase = "alert alert-success";
						$status = "Completada";
					?>
				}
				@elseif($row->status == 0)
				{
					<?php 
						$clase = "alert alert-warning";
						$status = "En espera";
					?>	
				}
				@else
				{	
					<?php 
						$clase = "alert alert-danger";
						$status = "Retrasada";
					?>	
				}
				@endif
					<tr class="<?php echo $clase; ?>">
						<td>{{$row->nombre_completo}}</td>
						<td>{{$row->bm}}</td>
						<td>{{$row->descripcion}}</td>
						<td><?php echo date('d-m-Y H:i:s A', strtotime($row->created_at)); ?></td>
						<td>
							<?php echo $status; ?>
						</td>
						<td>
							<button type="button" class="btn btn-primary">
								Finalizar&nbsp;<i class="fa fa-thumbs-up"></i>
							</button>
						</td>
					</tr>	
			@endforeach
		</tbody>
	</table>
@endsection