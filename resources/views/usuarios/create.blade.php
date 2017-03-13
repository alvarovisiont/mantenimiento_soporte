@extends('layout.admin')
@section('contenido')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Registrar</div>
                <div class="panel-body">
                    {!! Form::open(['url' => 'usuarios', 'method' => 'POST' , 'class' => 'form-horizontal', 'id' => 'form_agregar']) !!}
                        <div class="form-group">
                            <label for="usuario" class="col-md-4 control-label">Trabajador</label>

                            <div class="col-md-6">  
                                {!! Form::select('trabajadores_id',['' => 'Seleccione un trabajador'] + $trabajadores, null,['class' => 'form-control', 'id' => 'trabajadores_combo']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="usuario" class="col-md-4 control-label">Soporte</label>

                            <div class="col-md-6">  
                                {!! Form::select('soportes_id',['' => 'Seleccione un soporte'] +$soportes, null,['class' => 'form-control', 'id' => 'soportes_combo']) !!}
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('usuario') ? ' has-error' : '' }}">
                            <label for="usuario" class="col-md-4 control-label">Usuario</label>

                            <div class="col-md-6">
                                <input id="usuario" type="usuario" class="form-control" name="usuario" value="{{ old('usuario') }}">

                                @if ($errors->has('usuario'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('usuario') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">Confirmar Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation">

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('nivel') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Nivel</label>

                            <div class="col-md-6">
                                <select name="nivel" id="nivel" class="form-control">
                                    <option>Seleccione..</option>
                                    <option value="1">Administrador</option>
                                    <option value="2">Soporte</option>
                                    <option value="3">Trabajador</option>
                                </select>

                                @if ($errors->has('nivel'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nivel') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i> Registrar
                                </button>
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <p class="alert alert-danger text-center" id="aviso" style="display: none">Debe seleccionar un trabajador o un soporte&nbsp;<i class="fa fa-exclamation-circle"></i></p>
                        </div>
                    {!! form:: close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        $(function()
        {
            $("#tabla").dataTable({

                "language" : {"url" : "json/esp.json"}
            });

            $("#trabajadores_combo").change(function(event) {
                $("#soportes_combo").val('').prop('selected');
            });

            $("#soportes_combo").change(function(event) {
                $("#trabajadores_combo").val('').prop('selected');
            });

            $("#form_agregar").submit(function(event) {
                var trabajadores = $("#trabajadores_combo").val(),
                    soportes = $("#soportes_combo").val();

                    if(trabajadores == "" && soportes == "")
                    {
                        $("#aviso").show('slow/400/fast',function(){
                            setTimeout(function(){
                                $("#aviso").hide('slow');
                            },2500);
                        });

                        return false;
                    }
            });
        });
        
    </script>
@endsection 