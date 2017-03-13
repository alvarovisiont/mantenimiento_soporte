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
				<div class="alert alert-danger" id="aviso" style="display: none;">
				 <h5 class="text-center">Debe escoger algún registro para ser restaurado&nbsp;<i class="fa fa-exclamation-circle"></i></h5>
			    </div>
			</div>
		</div>
	<section class="content-header">
      <h1>
        Correo Basura
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">correspondencia</li>
        <li class="active">Basura</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-3">
        	<button type="button" class="btn btn-primary btn-block margin-bottom restaurar">Restaurar&nbsp;<i class="fa fa-plus" aria-hidden="true"></i></button>
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
              <h3 class="box-title">Inbox Basura</h3>

              <div class="box-tools pull-right">
                <div class="has-feedback">
                  <!--<input type="text" class="form-control input-sm" placeholder="Buscar Correo">
                  <i class="fa fa-search form-control-feedback"></i>-->
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
		                    <td class="mailbox-name"><a href="#">{{$mail->iniciado($row->id)}}</a></td>
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
@endsection

@section('script')
	<script src="{{ asset('js/jquery-ui.min.js') }}"></script>
	<script>
		$(function()
		{
			var checkbox = false;

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
				var agree = confirm("Esta seguro de querer eliminar de manera permanente estos correos?");
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
							window.location.replace('{{url("/correspondencia/eliminarPermanente")}}'+"/"+ids);
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

// ================================= funciones para restaurar correo =================================
	
		
		function pregunta1()	
		{
				var agree = confirm("Esta seguro de querer restaurar estos correos?");
				return agree;
		}

		$(".restaurar").click(function(event) {
			var ids = "";
			$("#tabla").children('tbody').children('tr').children('.td-checkbox').children('input[type="checkbox"]').each(function(){
				if($(this).is(':checked'))
				{
					ids += $(this).val()+",";
				}
			});

			if(ids != "")
			{
				var confirm = pregunta1();
				if(confirm)
				{
					var longitud = ids.length -1;
					ids = ids.substring(0, longitud);
					window.location.replace('{{url("/correspondencia/restaurar")}}'+"/"+ids);
				}
			}
			else
			{	
				$("#aviso").empty().html('Debe escoger correos para ser restaurados&nbsp;<i class="fa fa-exclamation-circle"></i>').show('slow/400/fast');
				setTimeout(function(){
					$("#aviso").hide('slow');
				},2500);

			}
		});
	
//=====================================================================================================

// ===================================Recargar la Pág=================================================

		$(".refresh").click(function(){
			window.location.reload();
		});


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