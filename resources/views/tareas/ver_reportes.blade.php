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
				<th>Reportes</th>
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
						<button class="btn btn-primary btn-md" data-toggle="modal" data-target="#modal_reporte" data-id = "{{$row->falla_id}}"><i class="fa fa-search"></i></button>
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
					<h4 class="modal-title">Reportes Realizados</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-7 col-md-offset-3" id="barra_oculta" style="display:none">
							<div class="progress progress-striped active">
								  	<div class="progress-bar" role="progressbar"
								       aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"
								       style="width: 100%">
								       <span>Cargando...</span>
								    	<span class="sr-only">45% completado</span>
								  </div>
							</div>
						</div>
						<div id="contenido_reportes" class="col-md-12">
							
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
				</div>
			</div>
		</div>
	</div>
	@php 
		$ruta = asset('img/reportes');
	@endphp
@endsection

@section('script')
	<script src="{{ asset('js/lightbox.js') }}"></script>
	<script>
		$(function(){

			$("#modal_reporte").on('show.bs.modal', function(e){
				$("#barra_oculta").show('slow/400/fast');
				var id = $(e.relatedTarget).data().id;

				$.ajax({
					url: "../fallas/traer_reportes",
					type: "GET",
					data: {id: id},
					dataType: "JSON",
					success: function(data)
					{
						if(data.respuesta)
						{
							var imagenes = "",
								contenedor_img = "",
								col = "",
								contenido = "",
								cuerpo_reporte = "",
								nombre_completo = "",
								fecha = "";
								ruta_imagenes = "<?php echo $ruta.'/'; ?>",
								cantidad = data['reportes'].length;

								for(var i = cantidad - 1; i >= 0; i--)
								{
									cuerpo_reporte = data['reportes'][i].cuerpo_reporte;
									nombre_completo = data['reportes'][i].nombre_completo;
									fecha = data['reportes'][i].created_at;
									imagenes = data['reportes'][i].imagenes.split(',');
									if(imagenes.length >= 4)
									{
										col = 3;
									}
									else
									{
										col = Math.round(12 / imagenes.length);
									}

									for (var y = imagenes.length -1; y >= 0; y--) 
									{
										contenedor_img += "<div class='col-md-"+col+" text-center'><a href='"+ruta_imagenes+imagenes[y]+"' data-lightbox='example-"+i+"'><img src='"+ruta_imagenes+imagenes[y]+"' width='120'></a></div>";	
									}

									contenido+= "<div class='col-md-12'><h2 class='text-center'>Soporte: "+nombre_completo+"</h2><br><div class='col-md-12'><p style='text-indent: 3em; font-size:16px;'>"+cuerpo_reporte+"</p></div><br>"+contenedor_img+"<p class='text-right'> Fecha del Reporte: <strong>"+fecha+"</strong></p></div>";
									contenedor_img = "";
								}

							$("#barra_oculta").hide('slow');
							$("#contenido_reportes").empty().html(contenido);
						}
						else
						{
							$("#barra_oculta").hide('slow');
							$("#contenido_reportes").empty().html('<h4 class="text-center">No hay reportes hechos todavía</h4>');	
						}

					}
				});
			});
		});
	</script>
@endsection