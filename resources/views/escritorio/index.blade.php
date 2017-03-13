@extends('layout.admin')

@section('contenido')
<div class="col-lg-3 col-md-3">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-3">
                    <i class="fa fa-desktop fa-5x"></i>
                </div>
                <div class="col-xs-9 text-right">
                    <div class="huge"></div>
                    <div>Equipos</div>
                    <div style="font-size: 2em;">@if(isset($equipos)) {{$equipos}} @endif</div>
                </div>
            </div>
        </div>
        <a href="{{ url('/equipos') }}">
            <div class="panel-footer">
                <span class="pull-left">Ver detalles</span>
                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                <div class="clearfix"></div>
            </div>
        </a>
    </div>
</div>
<div class="col-lg-3 col-md-6">
<div class="panel panel-green">
<div class="panel-heading">
    <div class="row">
        <div class="col-xs-3">
            <i class="fa fa-users fa-5x"></i>
        </div>
        <div class="col-xs-9 text-right">
            <div class="huge"></div>
            <div>Usuarios</div>
            <div style="font-size: 2em;">@if(isset($usuarios)) {{$usuarios}} @endif</div>
        </div>
    </div>
</div>
<a href="{{ url('/usuarios') }}">
    <div class="panel-footer">
        <span class="pull-left" style="color: #5cb85c;">Ver Detalles</span>
        <span class="pull-right" style="color: #5cb85c;"><i class="fa fa-arrow-circle-right"></i></span>
        <div class="clearfix"></div>
    </div>
</a>
</div>
</div>
<div class="col-lg-3 col-md-3">
    <div class="panel panel-yellow">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-3">
                    <i class="fa fa-wrench fa-5x"></i>
                </div>
                <div class="col-xs-9 text-right">
                    <div class="huge"></div>
                    <div>Fallas</div>
                    <div style="font-size: 2em;">@if(isset($fallas)) {{$fallas}} @endif</div>
                </div>
            </div>
        </div>
        <a href="{{ url('/fallas')}}">
            <div class="panel-footer">
                <span class="pull-left">Ver detalles</span>
                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                <div class="clearfix"></div>
            </div>
        </a>
    </div>
</div>
<div class="col-lg-3 col-md-6">
    <div class="panel panel-red">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-3">
                    <i class="fa fa-envelope fa-5x fa-fw"></i>
                </div>
                <div class="col-xs-9 text-right">
                    <div class="huge"></div>
                    <div>Correspondencia</div>
                    <div style="font-size: 2em;">@if(isset($correos)) {{$correos}} @endif</div>
                </div>
            </div>
        </div>
        <a href="{{ url('/correspondencia') }}">
            <div class="panel-footer">
                <span class="pull-left">Ver Detalles</span>
                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                <div class="clearfix"></div>
            </div>
        </a>
    </div>
</div>

<table class="table table-bordered table-hover" id="tabla">
        <thead>
            <tr>
                <th class="text-center">Trabajador</th>
                <th class="text-center">Equipo</th>
                <th class="text-center">Descripción</th>
                <th class="text-center">Fecha Reporte</th>
                <th class="text-center">Status</th>
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
                    </tr>   
            @endforeach
        </tbody>
    </table>
    @php 
        $ruta = asset('img/reportes');
        $nivel = Auth::user()->nivel;
    @endphp
@endsection

@section('script')
    <script>
    $(function()
    {
        $("#tabla").dataTable({
            "language" : {"url" : "json/esp.json"},
            order: ['3', 'desc']
        });

        $("#tabla").children('tbody').children('tr').click(function(event) {
            
            var nivel = <?php echo $nivel; ?>;

            if(nivel != 2)
            {
                window.location.replace('{{ url("/fallas")}}');    
            }
        });
    });
    </script>
@endsection