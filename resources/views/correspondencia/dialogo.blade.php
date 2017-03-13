@extends('layout.admin')

@section('contenido')
	<section class="content-header">
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">correspondencia</li>
        <li class="active">Ver Mensajes</li>
      </ol>
    </section>
    <br>
    <section class="content">
      <div class="row">
        <div class="col-md-3">
          <button type="button" class="btn btn-primary btn-block margin-bottom redactar" data-id="{{$conversacion->id}}">Responder&nbsp;<i class="fa fa-pencil"></i></button>
          <button type="button" class="btn btn-primary btn-danger margin-bottom btn-block eliminar" data-id="{{$conversacion->id}}">Eliminar&nbsp;<i class="fa fa-trash"></i></button>

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
                <li><a href="#"><i class="fa fa-trash-o"></i> Basura</a></li>
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
              <h3 class="box-title">Mensaje</h3>

              <div class="box-tools pull-right">
                <div class="has-feedback">
                	<b>
					@php
						echo date('d-m-Y H:i:s A', strtotime($conversacion->created_at));
					@endphp
					</b>
                </div>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            	<h3 class="text-center">{{$conversacion->subject}}</h3>
            	<p style="text-indent: 3em;">{{$conversacion->message}}</p>
            	@php

            		if($conversacion->files != "")
            		{
            			$array = explode(",", $conversacion->files);
            			$cantidad = count($array);
            			$col = "";
            			if($cantidad >= 4)
            			{
            				$col = 4;
            			}
            			else
            			{
            				$col = round(12 / $cantidad);
            			}

            			foreach ($array as $img) 
            			{
            				echo "<div class='col-md-".$col." text-center'>
									<a href='".asset('img/mails').'/'.$img."' data-lightbox='example'><img class='img-circle' src='".asset('img/mails').'/'.$img."' width='100'></a>
            						</div>";
            			}
            		}
            	@endphp
              <!-- /.mail-box-messages -->
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
        </div>
       </div>
  </section>
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
						{!! Form::select('soporte_id',$soportes->traer_soportes_respuesta($conversacion->soporte_id), null, ['class' => 'form-control', 'required']) !!}
					</div>
				</div>
			@else
				<div class="form-group">

					{!! Form::hidden('soporte_id', Auth::user()->trabajadores_id) !!}

					{!! Form::label('support', 'Para: ',['class' => 'control-label col-md-2']) !!}
					<div class="col-md-8 col-md-offset-1">
						{!! Form::select('trabajadores_id',$trabajadores->traer_trabajadores_respuesta($conversacion->trabajadores_id), null, ['class' => 'form-control', 'required']) !!}
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
				<div class="col-md-offset-2 col-md-5">
					<button class="btn btn-warning btn-block">Enviar&nbsp;<i class="fa fa-send"></i></button>
				</div>
				<div class="col-md-5">
					<button type="button" class="btn btn-default btn-block" id="cancelar">Cancelar&nbsp;<i class="fa fa-remove"></i></button>	
				</div>
			</div>
		{!! Form::close() !!}
	</div>
@endsection

@section('script')
	<script src="{{ asset('js/jquery-ui.min.js') }}"></script>
	<script src="{{ asset('js/lightbox.js') }}"></script>
	<script>
		$(function()
		{
			var checkbox = false;

			$("#dialog").dialog({
				autoOpen: false
			});

// ================================= Funciones para eliminar correos =================================
			
			function pregunta()
			{
				var agree = confirm("Esta seguro de querer eliminar este correo");
				return agree;
			}

			$(".eliminar").click(function(){
				var confirm = pregunta();
				if(confirm)
				{
					var id = $(this).data('id');
						window.location.replace('{{url("/correspondencia/eliminarUnico")}}'+"/"+id);
				}
				else
				{
					return confirm;
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


			/*$(".eliminar").click(function(e){

				var confirm = pregunta();
				
				if(confirm)
				{
					$("#barra_oculta").show('slow/400/fast');
					var tr = $(this).parent().parent();
					var form = $(".formulario_eliminar");
					var id = $(this).data('eliminar');
					var ruta = form.attr('action').replace(':USER', id);
					var data = form.serialize();

					$.ajax({
						url: ruta,
						type:'POST',
						dataType: 'JSON',
						data: data,
					})
					.done(function(data){
						if(typeof(data.exito) != "undefined")
						{
							$("#barra_oculta").hide('slow/400/fast');
							tr.remove();
							$("#aviso").removeClass('alert-danger').addClass('alert-success').empty().html('Equipo eliminado con éxito&nbsp;<i class="fa fa-exclamation-circle"></i>').show('slow/400/fast');
							setTimeout(function(){
								$("#aviso").hide('slow/400/fast');
							},2500);	
						}
						else
						{
							$("#barra_oculta").hide('slow/400/fast');
							var titulo = $("#aviso").children('h5');
							titulo.text('').append('No se puede borrar este registro porque esta asociado con algún trabajador u otro registro en el sistema&nbsp;&nbsp;<i class="fa fa-exclamation-circle"></i>');

							$("#aviso").removeClass('alert-success').addClass('alert-danger').show('slow/400/fast');
							
							setTimeout(function(){
								$("#aviso").hide('slow/400/fast');
							},3500);		
						}
					});
				}
				else
				{
					return confirm;	
				}
			});*/


		});
	</script>
@endsection

