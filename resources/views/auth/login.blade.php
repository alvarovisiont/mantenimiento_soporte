<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Informática</title>
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


<body class="hold-transition">

    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                 <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                     <span class="sr-only">Toggle Navigation</span>
                     <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Alcaldía Soportes</a>
             </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#">Recuperar Contraseña</a></li>
                </ul>
            </div>
        </div>
    </nav>

<div class="container">
    <div class="row">
    <div class="login-logo">
      </div><!-- /.login-logo -->
        <?php
            $x = 0;
        ?>
        @if(isset($failedLogin))
            <div class="form-group">
                <div class="col-md-12">
                    <div class="alert alert-danger">
                     <h5 class="text-center">@php echo $failedLogin; @endphp &nbsp;<i class="fa fa-exclamation-circle"></i></h5>
                    </div>
                </div>
            </div>
             <?php 
                $x = 1;
             ?>
        @endif
        <div class="col-md-8 col-md-offset-2"> 
            <div class="panel panel-default">
                <div class="panel-heading"><strong>Login</strong></div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="usuario" class="col-md-4 control-label">Usuario</label>

                            <div class="col-md-6">
                                <input id="usuario" type="usuario" class="form-control" name="usuario" value="{{ old('email') }}">

                                @if ($errors->has('email'))
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

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Recordar
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-sign-in"></i> Entrar
                                </button>

                                <!--<a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password?</a>-->
                            </div>
                        </div>
                    </form>
                        </div><!-- /.login-box -->
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/jQuery-2.1.4.min.js') }}"></script>
        <!-- Bootstrap 3.3.5 -->
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
</body>

<script>
    $(function(){
        var validacion = <?php echo $x; ?>; 
        if(validacion == 1)
        {
            setTimeout(function(){
                $(".alert-danger").hide('slow');
            }, 2500);
            
        }
    });
</script>