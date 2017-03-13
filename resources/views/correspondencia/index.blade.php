@extends('layout.admin')

@section('contenido')
	
		<?php
			$x = 0;
			$mensajes_nuevos = $mail->cantidad_mensajes_nuevos();
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
				<div class="alert alert-danger" id="aviso" style="display: none;">
				 <h5 class="text-center">&nbsp;<i class="fa fa-exclamation-circle"></i></h5>
			    </div>
			</div>
		</div>
	<section class="content-header">
      <h1>
        Correo
        @if($mensajes_nuevos > 0)
        	@if($mensajes_nuevos == 1)
        		<small class="label bg-green">@php echo $mensajes_nuevos; @endphp Nuevo Mensaje</small>
        	@else
        		<small class="label bg-green">@php echo $mensajes_nuevos; @endphp Nuevos Mensajes</small>
        	@endif
        @endif
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">correspondencia</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-3">
          <button type="button" class="btn btn-primary btn-block margin-bottom redactar">Redactar&nbsp;<i class="fa fa-pencil"></i></button>

          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Carpetas</h3>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li class="active"><a href="{{url('/correspondencia')}}"><i class="fa fa-inbox"></i> Inbox
                  <span class="label label-primary pull-right">{{$mail->cantidad_mensajes()}}</span></a></li>
                <li><a href="{{url('/correspondencia/enviados')}}"><i class="fa fa-envelope-o"></i> Enviados<span class="label label-danger pull-right">{{$mail->cantidad_mensajes_enviados()}}</span></a></li>
                </li>
                <li><a href="{{url('/correspondencia/basura')}}"><i class="fa fa-trash-o"></i> Basura</a></li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Inbox</h3>

              <div class="box-tools pull-right">
                <div class="has-feedback">
                  <input type="text" class="form-control input-sm buscar_correo" placeholder="Buscar Correo">
                  <i class="fa fa-search form-control-feedback"></i>
                  <div id="barra_oculta" style="display:none">
					<br>
					<div class="progress progress-striped active">
						  	<div class="progress-bar progress-bar-warning" role="progressbar"
						       aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"
						       style="width: 100%">
						       <span>Buscando...</span>
						    	<span class="sr-only">45% completado</span>
						  </div>
					</div>
				</div>
                </div>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="mailbox-controls">
                <!-- Check all button -->
                <button type="button" class="btn btn-default btn-sm checkbox-toggle" title="seleccionar todos"><i class="fa fa-square-o"></i>
                </button>
                <div class="btn-group">
                  <button type="button" class="btn btn-default btn-sm eliminar_correos" title="eliminar"><i class="fa fa-trash-o"></i></button>
                </div>
                <!-- /.btn-group -->
                <button type="button" class="btn btn-default btn-sm refresh" title="refrescar"><i class="fa fa-refresh"></i></button>
                <div class="pull-right">
                  <!-- /.btn-group -->
                  <div class="btn-group">
                    <!--<button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>-->
                  </div>
                </div>
                <!-- /.pull-right -->
              </div>
              <div class="table-responsive mailbox-messages">
                <table class="table table-hover table-striped" id="tabla">
                  <tbody>
                  	@if($correos->count())
	                  @foreach($correos as $row)
		                  <tr>
		                    <td class="td-checkbox"><input type="checkbox" value="{{$row->id}}" class=""></td>
		                    @if($row->status == 1)
		                    	<td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a></td>
		                    @else
		                    	<td class="mailbox-star"><a href="#"><i class="fa fa-star text-default"></i></a></td>
		                    @endif
		                    <td class="mailbox-name"><a href="{{url('/correspondencia/dialogo/')}}{{"/".$row->id}}">{{$mail->iniciado($row->id)}}</a></td>
		                    <td class="mailbox-subject"><b>Asunto-correo</b> : {{$row->subject}}
		                    </td>
		                    <td class="mailbox-attachment"></td>
		                    <td class="mailbox-date"> 
		                    	<b>Enviado</b>
		                    	<?php
		                    		echo date('d-m-Y H:i:s A', strtotime($row->created_at));
		                    	?>
		                    </td>
		                  </tr>
	                  @endforeach
	                @else
	                	<td class="text-center">No hay correos por mostrar</td>
	                @endif
                  </tbody>
                </table>
                <!-- /.table -->
              </div>
              <!-- /.mail-box-messages -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer no-padding">
              <div class="mailbox-controls">
                <!-- Check all button -->
                <button type="button" class="btn btn-default btn-sm checkbox-toggle" title="Seleccionar Todos"><i class="fa fa-square-o"></i>
                </button>
                <div class="btn-group">
                  <button type="button" class="btn btn-default btn-sm eliminar_correos" title="Eliminar"><i class="fa fa-trash-o"></i></button>
                </div>
                <!-- /.btn-group -->
                <button type="button" class="btn btn-default btn-sm refresh" title="refrescar"><i class="fa fa-refresh"></i></button>
                <div class="pull-right">
                  <div class="btn-group">
                    <!--<button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>-->
                  </div>
                  <!-- /.btn-group -->
                </div>
                <!-- /.pull-right -->
              </div>
            </div>
          </div>
          <!-- /. box -->
          <div class="pull-right">
          	{{$correos->render()}}
          </div>
        </div>

	<div id="dialog" title="Enviar Mensaje" style="display:none">	
		{!! Form::open(['url' => 'correspondencia/create', 'method' => 'POST', 'class' => 'form-horizontal', 'id' => 'form_redactar', 'files' => true])  !!}
			
			{!! Form::hidden('status', 1)!!}
			{!! Form::hidden('sent_by', Auth::user()->trabajadores_id) !!}
			{!! Form::hidden('nivel', Auth::user()->nivel) !!}

			@if(Auth::user()->nivel == 1 || Auth::user()->nivel == 3)

				{!! Form::hidden('trabajadores_id', Auth::user()->trabajadores_id) !!}

				<div class="form-group">
					{!! Form::label('support', 'Para: ',['class' => 'control-label col-md-2']) !!}
					<div class="col-md-8 col-md-offset-1">
						{!! Form::select('soporte_id',[null => 'Escoja un soporte'] + $soportes->traer_soportes(), null, ['class' => 'form-control', 'required']) !!}
					</div>
				</div>
			@else
				<div class="form-group">

					{!! Form::hidden('soporte_id', Auth::user()->trabajadores_id) !!}

					{!! Form::label('support', 'Para: ',['class' => 'control-label col-md-2']) !!}
					<div class="col-md-8 col-md-offset-1">
						{!! Form::select('trabajadores_id',[null => 'Escoja un trabajador'] + $trabajadores->traer_trabajadores(), null, ['class' => 'form-control', 'required']) !!}
					</div>
				</div>
			@endif
			<div class="form-group">
				{!! Form::label('subject', 'Asunto',['class' => 'control-label col-md-2']) !!}
				<div class="col-md-8 col-md-offset-1">
					{!! Form::text('subject', null,['class' => 'form-control', 'required']) !!}
				</div>
			</div>
			<hr>
			<div class="form-group">
				{!! Form::label('message', 'Mensaje',['class' => 'control-label col-md-2']) !!}
				<div class="col-md-8 col-md-offset-1">
					{!! Form::textarea('message', null,['class' => 'form-control', 'required', 'rows' => '4']) !!}
				</div>
			</div>
			<div class="form-group">
				{!! Form::label('files', 'Archivos',['class' => 'control-label col-md-2']) !!}
				<div class="col-md-8 col-md-offset-1">
					{!! Form::file('archivos[]', ['multiple']) !!}
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
			<div class="form-group">
				<div class="col-md-offset-2 col-md-5">
					<button class="btn btn-warning btn-block">Enviar&nbsp;<i class="fa fa-send"></i></button>
				</div>
				<div class="col-md-5">
					<button type="button" class="btn btn-default btn-block" id="cancelar">Cancelar&nbsp;<i class="fa fa-remove"></i></button>	
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
		{!! Form::close() !!}
	</div>
@endsection

@section('script')
	<script src="{{ asset('js/jquery-ui.min.js') }}"></script>
	<script>
		$(function()
		{
			var checkbox = false;

			$("#dialog").dialog({
				autoOpen: false
			});

			var validacion = <?php echo $x; ?>; 
			if(validacion == 1)
			{
				setTimeout(function(){
					$(".alert-success").hide('slow/400/fast');
				}, 2500);
				
			}

// ================================= Funciones para eliminar correos =================================
			
			function pregunta()
			{
				var agree = confirm("Esta seguro de querer eliminar estos registros");
				return agree;
			}

			$(".eliminar_correos").click(function(){

					var ids = "";
					$("#tabla").children('tbody').children('tr').children('.td-checkbox').children('input[type="checkbox"]').each(function(){
						if($(this).is(':checked'))
						{
							ids += $(this).val()+",";
						}
					});

					if(ids != "")
					{
						var confirm = pregunta();
						if(confirm)
						{
							var longitud = ids.length -1;
							ids = ids.substring(0, longitud);
							window.location.replace('{{url("/correspondencia/eliminar")}}'+"/"+ids);
						}
					}
					else
					{
						$("#aviso").empty().html('Debe escoger correos para ser eliminados&nbsp;<i class="fa fa-exclamation-circle"></i>').show('slow/400/fast');
						setTimeout(function(){
							$("#aviso").hide('slow');
						},2500);
					}
					
			});

			$(".checkbox-toggle").click(function(){
					if(checkbox == false)
					{	
						$("#tabla").children('tbody').children('tr').children('.td-checkbox').children('input[type="checkbox"]').prop('checked', true);
						checkbox = true;
					}
					else
					{
						$("#tabla").children('tbody').children('tr').children('.td-checkbox').children('input[type="checkbox"]').prop('checked', false);
						checkbox = false;
					}
			});	

// ================================= funciones del dialog de redactar =================================

			$(".redactar").click(function(){
				$("#dialog").dialog("option", "width", 600);
				$("#dialog").dialog("option", "height", 400);
				$("#dialog").dialog('open');
			});

			$("#cancelar").click(function(){
				$("#dialog").dialog('close');
				$("#form_redactar")[0].reset();
			});
//=====================================================================================================

// ===================================Recargar la Pág=================================================

		$(".refresh").click(function(){
			window.location.reload();
		});

// ======================== FUNCIONES DEL BUSCADOR ========================================================

		$(".buscar_correo").keyup(function(e){
			
			var campo = $(this);
			if(campo.val() == "")
			{

			}
			else
			{
				
				if(campo.val().length > 1)
				{
					$("#barra_oculta").show('slow/400/fast');
				}
				else
				{
					$("#barra_oculta").hide('slow/400/fast');	
				}

				$(".buscar_correo" ).autocomplete({
		            source: function(request, response)
		            {
		                $.ajax({
		                    url : "{{ url('/correspondencia/traerCorreosEnviados') }}",
		                    type: "GET",
		                    dataType: "JSON",
		                    data: {art : request.term},
		                    success: function(data)
		                    {
		                    	$("#barra_oculta").hide('slow/400/fast');
		                    	var array = [];
		                    	$.grep(data,function(e,i)
		                    	{
		                    		array.push(e.subject);
		                    	});
		                    	console.log(array);
		                        response(array);
		                    }
		                });
		            },
		            minLenght: 2,
		            select: function(e, ui)
		            {
		            	window.location.replace("{{url('/correspondencia/dialogo_search')}}"+"/"+ui.item.label);
		            }
      			});
			}

		});

		$("#form_redactar").submit(function(event) {
			$("#barra_oculta_enviar").show('slow/400/fast');
		});
	});
	</script>
@endsection