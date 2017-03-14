@extends('layout.admin')
@section('contenido')
	@include('equipos.partials.form',['url' => 'equipos/'.$equipo->id, 'method' => 'PATCH', 'equipo' => $equipo])
@endsection

@section('script')
	<script>
		$(function(){
			$("#otras_caracterisitcas").click(function(event) {
				if($(this).is(':checked'))
				{
					$("#div_oculto").show('slow/400/fast', function(){
						$("#tipo").val('').prop({
							'selected' : true,
							'disabled' : false
						});

					});
				}
				else
				{
					$("#div_oculto").hide('slow/400/fast', function(){
						$("#tipo").prop('disabled', false);
						$("#caracteristicas_extras").empty();
					});
				}
			});

			$("#modal_caracteristicas").on('show.bs.modal', function(){

				$("#barra_oculta").show('slow/400/fast');

				$("#tabla").children('tbody').html('');

				$.get('{{ url("/equipos/caracteristicas") }}', {}, function(data){
					var filas = "";

					$.grep(data,function(e,i)
					{
						filas += "<tr><td>"+e.id+"</td><td>"+e.tipo+"</td></tr>";
					});
					
					$("#barra_oculta").hide('slow');
					
					$("#tabla").children('tbody').html(filas);
				});
			});
		});
	</script>
@endsection