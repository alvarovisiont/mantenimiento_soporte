@extends('layout.admin')

@section('contenido')
	
	<h2 class="text-center">Fallas Reportadas&nbsp;&nbsp;<img src="{{ asset('img/listas.jpg')}}" alt="" width="70"></h1>
	<table class="table table-bordered table-hover" id="tabla_fallas">
		<thead>
			<tr>
				<th class="text-center">Trabajador</th>
				<th class="text-center">Equipo</th>
				<th class="text-center">Descripción</th>
				<th class="text-center">Fecha Reporte</th>
				<th class="text-center">Status</th>
				<th class="text-center">Reportes</th>
				<th class="text-center">Asignar</th>
			</tr>
		</thead>
		<tbody class="text-center">
			@foreach($datos as $row)

				@if($row->status == 1)
				
					<?php 
						$clase = "alert alert-success";
						$status = "Completada";
					?>
				
				@elseif($row->status == 0)
				
					<?php 
						$clase = "alert alert-danger";
						$status = "En espera";
					?>	
				
				@else
					
					<?php 
						$clase = "alert alert-danger";
						$status = "Retrasada";
					?>	
				
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
							<button class="btn btn-primary btn-md" data-toggle="modal" data-target="#modal_reporte" data-id = "{{$row->id}}"><i class="fa fa-search"></i></button>
						</td>
						<td>
							@if($row->status != 1 && $row->soporte_id == "")
								<button type="button" class="btn btn-warning" data-toggle="modal" data-target="	#modal_soporte" 
									data-id_falla = "{{$row->id}}" 
									data-descripcion= "{{$row->descripcion}}" 
									data-id_trabajador="{{$row->trabajador_id}}" 
									data-id_equipo="{{$row->equipos_id}}"
									data-fecha_tarea = "{{$row->created_at}}"
									data-soporte = "{{$row->soporte_id}}"
									>
									Asignar&nbsp;<i class="fa fa-pencil"></i>
								</button>

							@elseif($row->status != 1 && $row->soporte_id != "")

								<button type="button" class="btn btn-warning" data-toggle="modal" data-target="	#modal_soporte_modificar" 
									data-id_falla = "{{$row->id}}" 
									data-soporte = "{{$row->soporte_id}}"
									>
									Modificar&nbsp;<i class="fa fa-edit"></i>
								</button>

							@endif
						</td>
					</tr>	
			@endforeach
		</tbody>
	</table>
	<div class="modal fade" id="modal_soporte" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog tabla_modal" role="document">
          <div class="modal-content">
            <div class="modal-header encabezado_modal">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <h3 class="text-center">Soportes Registrados</h3>
            </div>
            <div class="modal-body">
              <div class="row">
				<div class="col-md-12">
					<div class="form-group">
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
					</div>
					<input type="hidden" id="id_equipo">
					<input type="hidden" id="descripcion">
					<input type="hidden" id="id_trabajador">
					<input type="hidden" id="id_falla">
					<input type="hidden" id="fecha_tarea">
					<p class="alert alert-success text-center" id="aviso" style="display: none"></p>
					
					<table class="table table-bordered table-hover" id="tabla_soportes">
						<thead>
							<tr>
								<th class="text-center">Soporte</th>
								<th class="text-center">Nº de Tareas por Completar</th>
								<th class="text-center">Asignar</th>
							</tr>
						</thead>
						<tbody class="text-center">
							
						</tbody>
					</table>
				</div>
              </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-default" data-dismiss='modal'>Cerrar&nbsp;<i class="fa fa-remove"></i></button>
            </div>
          </div>
      </div>
    </div>
    <div class="modal fade" id="modal_soporte_modificar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog tabla_modal" role="document">
          <div class="modal-content">
            <div class="modal-header encabezado_modal">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <h3 class="text-center">Soportes Registrados</h3>
            </div>
            <div class="modal-body">
              <div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<div class="col-md-7 col-md-offset-3" id="barra_oculta_modificar" style="display:none">
							<div class="progress progress-striped active">
								  	<div class="progress-bar" role="progressbar"
								       aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"
								       style="width: 100%">
								       <span>Cargando...</span>
								    	<span class="sr-only">45% completado</span>
								  </div>
							</div>
						</div>
					</div>

					<input type="hidden" id="id_falla_modificar">

					<p class="alert alert-success text-center" id="aviso_modificar" style="display: none"></p>
					
					<table class="table table-bordered table-hover" id="tabla_soportes_modificar">
						<thead>
							<tr>
								<th class="text-center">Soporte</th>
								<th class="text-center">Nº de Tareas por Completar</th>
								<th class="text-center">Asignar</th>
							</tr>
						</thead>
						<tbody class="text-center">
							
						</tbody>
					</table>
				</div>
              </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-default" data-dismiss='modal'>Cerrar&nbsp;<i class="fa fa-remove"></i></button>
            </div>
          </div>
      </div>
    </div>
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
<!-- ============================== Variable para traer las imagenes de los reportes ======================-->
	@php 
		$ruta = asset('img/reportes');
	@endphp
<!-- ======================================================================================================-->
@endsection

@section('script')
	<script src="{{ asset('js/lightbox.js') }}"></script>
	<script>
		$(function(){
			$("#tabla_fallas").dataTable({
				"language" : {"url" : "json/esp.json"},
				order: [4, "desc"]
			});

// ================================== Modal para asignar la tarea ============================= //

			$("#modal_soporte").on('show.bs.modal', function(e){
				
				$("#barra_oculta").show('slow/400/fast');

				$("#tabla_soportes").children('tbody').empty();

				var x = $(e.relatedTarget).data().descripcion;
						$("#descripcion").val(x);
				var x = $(e.relatedTarget).data().id_trabajador;
						$("#id_trabajador").val(x);
				var x = $(e.relatedTarget).data().id_equipo;
						$("#id_equipo").val(x);
				var x = $(e.relatedTarget).data().id_falla;
						$("#id_falla").val(x);
				var x = $(e.relatedTarget).data().fecha_tarea;
						$("#fecha_tarea").val(x);
				var soporte = $(e.relatedTarget).data().soporte;
				
				$.get('fallas/traer_soportes', function(data){
					
					$("#barra_oculta").hide('slow');
					var fila = "";

					$.grep(data['soportes'], function(e,i){
						if(e.id == soporte)
						{
							fila += "<tr class='alert alert-success'><td>"+e.nombre_completo+"</td><td>"+e.tareas+"</td><td><button class='btn btn-success btn-sm asignar' data-id='"+e.id+"'>Asignar&nbsp;<i class='fa fa-pencil'></i></button></td></tr>";	
						}
						else
						{
							fila += "<tr><td>"+e.nombre_completo+"</td><td>"+e.tareas+"</td><td><button class='btn btn-success btn-sm asignar' data-id='"+e.id+"'>Asignar&nbsp;<i class='fa fa-pencil'></i></button></td></tr>";	
						}
						
					});

					$("#tabla_soportes").children('tbody').html(fila);	
				});
			});
//=================================== Modal para modificar el encargado de la tarea ===================//
			
			$("#modal_soporte_modificar").on('show.bs.modal', function(e){
				
				$("#barra_oculta_modificar").show('slow/400/fast');
				;

				$("#tabla_soportes_modificar").children('tbody').empty();

				var x = $(e.relatedTarget).data().id_falla;
						$("#id_falla_modificar").val(x);
				
				var soporte = $(e.relatedTarget).data().soporte;
				

				$.get('fallas/traer_soportes', function(data){
					
					$("#barra_oculta_modificar").hide('slow');
					var fila = "";

					$.grep(data['soportes'], function(e,i){
						if(e.id == soporte)
						{
							fila += "<tr class='alert alert-info'><td>"+e.nombre_completo+"</td><td>"+e.tareas+"</td><td></td></tr>";	
						}
						else
						{
							fila += "<tr><td>"+e.nombre_completo+"</td><td>"+e.tareas+"</td><td><button class='btn btn-success btn-sm asignar_modificar' data-id='"+e.id+"'>Re-Asignar&nbsp;<i class='fa fa-pencil'></i></button></td></tr>";	
						}
						
					});

					$("#tabla_soportes_modificar").children('tbody').html(fila);	
				});
			});

//===============================Asignar y modificar a quien se le asigno la tarea====================

			$("#tabla_soportes tbody").on('click', 'tr td .asignar', function()
			{
				var falla_id = $("#id_falla").val(),
					trabajadores_id = $("#id_trabajador").val(),
					soporte_id = $(this).data().id,
					equipo_id = $("#id_equipo").val(),
					descripcion = $("#descripcion").val(),
					fecha_tarea = $("#fecha_tarea").val();

					$.ajax({
						url: '{{url('tareas')}}',
						type: 'POST',
						data: {falla_id : falla_id, trabajadores_id: trabajadores_id, soporte_id: soporte_id, equipo_id: equipo_id, descripcion: descripcion, fecha_tarea: fecha_tarea},
					})
					.done(function() {
						$("#aviso").empty().html('Tarea asignada con éxito&nbsp;<i class="fa fa-exclamation-circle"></i>').show('slow/400/fast', function(){
							setTimeout(function(){
								$("#aviso").hide();
								$("#modal_soporte").modal('hide');
								window.location.reload();
							}, 2500);
							
						});
					});
			});

			$("#tabla_soportes_modificar tbody").on('click', 'tr td .asignar_modificar', function()
			{
				var falla_id = $("#id_falla_modificar").val(),
					soporte_id = $(this).data().id;

					$.ajax({
						url: 'tareas/reasignar',
						type: 'POST',
						data: {falla_id : falla_id, soporte_id: soporte_id},
					})
					.done(function() {
						$("#aviso_modificar").empty().html('Tarea re-asignada con éxito&nbsp;<i class="fa fa-exclamation-circle"></i>').show('slow/400/fast', function(){
							setTimeout(function(){
								$("#aviso_modificar").hide();
								$("#modal_soporte_modificar").modal('hide');
								window.location.reload();
							}, 2500);
							
						});
					});
			});
// *******************************************************************************************************

// =========================== Ver reportes de las tareas ===============================================

	$("#modal_reporte").on('show.bs.modal', function(e){
		$("#barra_oculta").show('slow/400/fast');
		var id = $(e.relatedTarget).data().id;

		$.ajax({
			url: "fallas/traer_reportes",
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