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
				<th colspan="9" class="text-center" style="color: #4F97E8">Equipos de la alcaldía</th>
			</tr>
			<tr>
				<th class="text-center">BM_equipo</th>
				<th class="text-center">Nom_equipo</th>
				<th class="text-center">IP</th>
				<th class="text-center">BM_MONITOR</th>
				<th class="text-center">BM_RATÓN</th>
				<th class="text-center">BM_TECLADO</th>
				<th class="text-center">Caracteristicas</th>
				<th class="text-center">Color</th>
				<th class="text-center">Status</th>
			</tr>
		</thead>
		<tbody>
			@foreach($datos as $row)
				@php
					
					$caracteristicas = "";
					$status = "";

					if($row->caracteristicas == "" || $row->caracteristicas == null)
					{
						$caracteristicas = $row->caracteristicas_extras;
					}
					else
					{
						$caracteristicas = $row->caracteristicas;	
					}

					if($row->status == 0)
					{
						$status = "Disponible";
					}
					elseif($row->status == 1)
					{
						$status = "En uso";	
					}
					elseif($row->status == 2)
					{
						$status = "En reparación";	
					}
					else
					{
						$status = "Extraviada";	
					}
				@endphp

				<tr>
					<td class="text-center">{{$row->bm}}</td>
					<td class="text-center">{{$row->nom_equipo}}</td>
					<td class="text-center">{{$row->ip}}</td>
					<td class="text-center">{{$row->monitor}}</td>
					<td class="text-center">{{$row->raton}}</td>
					<td class="text-center">{{$row->teclado}}</td>
					<td class="text-center">@php echo $caracteristicas @endphp</td>
					<td class="text-center">{{$row->color}}</td>
					<td class="text-center">@php echo $status @endphp</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</body>
</html>