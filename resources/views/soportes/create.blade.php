@extends('layout.admin')

@section('contenido')

{!! Form::open(['id'=> 'reg-per','class' => 'form-horizontal', 'url' => 'soportes', 'method' => 'POST']) !!}
<div class="container">
	<div class="row">
		<div class="col-md-8">
					<div class="form-group {{ $errors->has('cedula') ? ' has-error' : '' }}">
						<label for="cedula">Cedula</label>
						<input type="text" name="cedula"  value="{{old('cedula')}}" class="form-control" placeholder="Cedula">
						 @if ($errors->has('cedula'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('cedula') }}</strong>
                                    </span>
                                @endif
					</div>
				</div>
			<div class="col-md-8">
				<div class="form-group {{ $errors->has('nombre_completo') ? ' has-error ' : '' }}">
					<label for="nombre">Nombre completo</label>
					<input type="text" name="nombre_completo"  value="{{old('nombre_completo')}}" class="form-control" placeholder="Nombre completo">
					@if ($errors->has('nombre_completo'))
						<span class="help-block">
							<strong>{{ $errors->first('nombre_completo') }}</strong>
						</span>
					@endif
				</div>
			</div>
	</div>
</div>
		<div class="form-group">
         <div class="col-md-6 col-md-offset-4">
              <button id="reg" type="submit" class="btn btn-primary"><i class="fa fa-btn fa-user"></i> Registrar</button>
          </div>
      </div>

{!! Form::close() !!}

@endsection

