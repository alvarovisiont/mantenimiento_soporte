@extends('layout.admin')

@section('contenido')

{!! Form::open(['id'=> 'reg-per','class' => 'form-horizontal', 'url' => 'soportes', 'method' => 'POST']) !!}
			<div class="form-group">
				<h2 class="text-center">Soporte Nuevo</h2>
			</div>
			<div class="form-group">
				<label for="cedula" class="col-md-1 col-md-offset-1">Cédula</label>
				<div class="col-md-4 {{ $errors->has('cedula') ? ' has-error' : '' }}">
					<input type="number" name="cedula"  value="{{old('cedula')}}" class="form-control" placeholder="Cédula" required="" min="0">
					 @if ($errors->has('cedula'))
	                    <span class="help-block">
	                        <strong>{{ $errors->first('cedula') }}</strong>
	                    </span>
	                @endif
				</div>
				<label for="nombre" class="control-label col-md-2">Nombre completo</label>
				<div class="col-md-4 {{ $errors->has('nombre_completo') ? ' has-error ' : '' }}">
					<input type="text" name="nombre_completo"  value="{{old('nombre_completo')}}" class="form-control" placeholder="Nombre completo" required="">
					@if ($errors->has('nombre_completo'))
						<span class="help-block">
							<strong>{{ $errors->first('nombre_completo') }}</strong>
						</span>
					@endif	
				</div>
			</div>
			<br>
			<div class="form-group">
	        	<div class="col-md-4 col-md-offset-4">
	              	<button id="reg" type="submit" class="btn btn-primary btn-block">Registrar&nbsp;<i class="fa fa-save"></i></button>
	          	</div>
	          	<div class="col-md-3 col-md-offset-1">
	          		<a href="{{ url('soportes') }}">Regresar al listado de soportes</a>
	          	</div>
	      	</div>

{!! Form::close() !!}

@endsection

