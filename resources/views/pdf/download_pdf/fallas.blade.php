<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Equipos PDF</title>
	<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
	<style>

		body {
		  font-family: "Arial", serif;
		}

		table {     font-family: "Arial", "Lucida Grande", Sans-Serif;
		    font-size: 12px;    margin: 45px;     width: 480px; text-align: center;    border-collapse: collapse; }

		th {     font-size: 13px;     font-weight: bold;     padding: 8px;
		    border-top: 4px solid #aabcfe;    border-bottom: 1px solid black; }

		td {    padding: 8px; border-bottom: 1px solid black;
		    border-top: 1px solid transparent; }
	</style>
</head>
<body>
	<table class="table table-bordered table-condensed">
		<thead>
			<tr>
				<th colspan="6" class="text-center" style="color: #4F97E8">Fallas Registradas</th>
			</tr>
			<tr>
				<th class="text-center">Trabajador</th>
				<th class="text-center">Equipo</th>
				<th class="text-center">Departamento</th>
				<th class="text-center">Descripción</th>
				<th class="text-center">Status</th>
				<th class="text-center">Fecha Registro</th>
			</tr>
		</thead>
		<tbody>
			@foreach($datos as $row)
				@php
					$status = "";

					if($row->caracteristicas == "")
					{
						$caracteristicas = $row->caracteristicas_extras;
					}
					else
					{
						$caracteristicas = $row->caracteristicas;	
					}

					if($row->status == 0)
					{
						$status = "En espera";
					}
					else
					{
						$status = "Atendida";	
					}

				@endphp

				<tr>
					<td class="text-center">{{$row->trabajador}}</td>
					<td class="text-center">{{$row->nom_equipo." - ".$row->bm}}</td>
					<td class="text-center">{{$row->departamento}}</td>
					<td class="text-center">{{$row->descripcion}}</td>
					<td class="text-center">@php echo $status;  @endphp</td>
					<td class="text-center">{{$row->created_at}}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</body>
</html>