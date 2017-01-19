
<!DOCTYPE html>
<html>
 <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Informatica</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('css/AdminLTE.min.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('css/_all-skins.min.css')}}">
    <link rel="apple-touch-icon" href="{{asset('img/apple-touch-icon.png')}}">
    <link rel="shortcut icon" href="{{asset('img/favicon.ico')}}">

  </head>
  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="#"><b>INGRESO AL SISTEMA</b></a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Ingrese sus datos de Acceso</p>
        {!! Form::open(['id'=>'login','route' => 'log.store' , 'method' => ' POST']) !!}

          <div class="form-group has-feedback">
          {!! Form::text('usuario', null  ,['class' => 'form-control' , 'placeholder' => 'Usuario','id' => 'usuario-id'])!!}

          </div>
          <div class="form-group has-feedback">
          {!! Form::password('password', ['class' => 'form-control' , 'placeholder' => 'Contraseña']) !!}

    
          </div>
          <div class="form-group">
            <div class="progress" style="display:none">
              <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">
              </div>
            </div>
          </div>
          
            <div id="msj-error">@if(Session::has('message-error'))

<div class="alert alert-danger alert-dismissable" role="alert">
  <button type="button" class="close" data-miss="alert" aria-label="Close"><span -hidden="true">&times;</span></button>
  {{Session::get('message-error')}}
</div>
@endif</div>
         
          <div class="row">
            <div class="col-xs-8">
              
            </div><!-- /.col -->
            <div class="col-xs-4">
             
              {!!Form::submit('Entrar',['id'=>'btn-login','class' => 'btn btn-primary btn-block btn-flat'])!!}

            </div><!-- /.col -->
          </div>
        </form>

        {!!Form::close()!!}

        
    
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

   

  </body>
</html>
<script src="{{ asset('js/jQuery-2.1.4.min.js') }}"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('js/app.min.js') }}"></script>
  
<script>
$(document).ready(function(event) {

  

  var btn = $("#btn-login");

  btn.click(function() {
  
  var form = $("#login");
  var ir = form.attr('action');
  var datos = $("#usuario-id").val();
  //var alert = $("msj-error");

  $.ajax({

      type: 'POST',
      url: ir,
      data: {usuario: datos},
      dateType: 'json',
      success: function(datos){
    
       //$("#msj-error").fadeOut('slow/400/fast');
      
      }
   
      })
   });

 });
</script>
