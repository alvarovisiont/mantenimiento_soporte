<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>PLANTILLA | MODIFICABLE</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('css/font-awesome.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('css/AdminLTE.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables/jquery.dataTables.css') }}"></link>
    <link rel="stylesheet" href="{{ asset('plugins/datatables/dataTables.bootstrap.css') }}"></link>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/select2.css') }} ">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/estilos.css') }} ">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('css/_all-skins.min.css') }}">
    
    @if(substr($_SERVER['REQUEST_URI'], -12) === "ver_reportes" || substr($_SERVER['REQUEST_URI'], -6) === "fallas")
      <link rel="stylesheet" type="text/css" href="{{ asset('css/lightbox.css') }} ">
    @endif

    @if(substr($_SERVER['REQUEST_URI'], -11) === "pdf/equipos" || substr($_SERVER['REQUEST_URI'], -6) === "fallas")
      <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-datepicker.css') }} ">
    @endif

    @if(substr($_SERVER['REQUEST_URI'], -15) === "correspondencia" || substr($_SERVER['REQUEST_URI'], -24) === "correspondencia/enviados")
      <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery-ui.min.css') }} ">
    @endif

    @if(substr($_SERVER['REQUEST_URI'], -9, -2) === "dialogo")
      <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery-ui.min.css') }} ">
      <link rel="stylesheet" type="text/css" href="{{ asset('css/lightbox.css') }} ">
    @endif

    @if(substr($_SERVER['REQUEST_URI'], -10, -3) === "dialogo")
      <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery-ui.min.css') }} ">
      <link rel="stylesheet" type="text/css" href="{{ asset('css/lightbox.css') }} ">
    @endif

    @if(substr($_SERVER['REQUEST_URI'], -11, -4) === "dialogo")
      <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery-ui.min.css') }} ">
      <link rel="stylesheet" type="text/css" href="{{ asset('css/lightbox.css') }} ">
    @endif

    @if(substr($_SERVER['REQUEST_URI'], -12, -5) === "dialogo")
      <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery-ui.min.css') }} ">
      <link rel="stylesheet" type="text/css" href="{{ asset('css/lightbox.css') }} ">
    @endif
    

    <!--<link rel="apple-touch-icon" href="{{ asset('img/apple-touch-icon.png') }}">-->
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
      <header class="main-header">

        <!-- Logo -->
        <a href="index2.html" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>P</b>TILLA</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>SOPORTE</b></span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Navegación</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <small class="bg-red">Online</small>&nbsp;&nbsp;&nbsp;&nbsp;
                  <span class="hidden-xs"></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    
                    <p class="text-center">
                      <i class="fa fa-user fa-5x"></i>
                      <br>
                      <span>Usuario: </span>{{Auth::user()->usuario}}
                      <br>
                      <span>Nivel: </span>
                      <strong>
                        @if(Auth::user()->nivel == 1)
                         {{"Administrador"}}
                        @elseif(Auth::user()->nivel == 2)
                          {{"Soporte"}}
                        @else
                          {{"Trabajador"}}
                        @endif
                      </strong>
                    </p>
                  </li>
                  
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    
                    <div class="pull-right">
                        <a href="{{ url('/logout') }}" class="btn btn-warning btn-flat">Salir</a>
                    </div>
                  </li>
                </ul>
              </li>
              
            </ul>
          </div>

        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
                    
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header"></li>
            
            <li>
              <a href="{{ url('escritorio') }}">
                 <small class=""><i class="fa fa-window-restore" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;</small><span>Escritorio</span>
              </a>
            </li>

            @if(Auth::user()->nivel != 3)
              <li class="treeview">
                <a href="#">
                  <i class="fa fa-home"></i> <span>Departamentos</span>
                  <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li><a href="{{url('departamentos/create')}}"><i class="fa fa-circle-o"></i>Agregar Departamentos</a></li>
                  <li><a href="{{url('departamentos')}}"><i class="fa fa-circle-o"></i>Administrar Departamentos</a></li>
                  
                </ul>
              </li>

              <li class="treeview">
                <a href="#">
                  <i class="fa fa-desktop"></i> <span>Equipos</span>
                  <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li><a href="{{url('equipos')}}"><i class="fa fa-circle-o"></i>Administración de equipos</a></li>
                  <li><a href="{{url('actualizar')}}"><i class="fa fa-circle-o"></i>Datos de Actualizaciones</a></li>
                </ul>
              </li>
            @endif

            @if(Auth::user()->nivel != 2)
              <li class="treeview">
                <a href="#">
                  <i class="fa fa-wrench" aria-hidden="true"></i> <span>Fallas</span>
                  <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li><a href="{{url('fallas')}}"><i class="fa fa-circle-o"></i>Ver fallas registradas</a></li>
                  <li><a href="{{url('fallas/create')}}"><i class="fa fa-circle-o"></i>Registrar Falla</a></li>
                </ul>
              </li>
            @endif
            @if(Auth::user()->nivel == 1)
              <li class="treeview">
                <a href="#">
                  <i class="fa fa-folder"></i> <span>Trabajadores</span>
                  <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li><a href="{{url('trabajadores/create')}}"><i class="fa fa-circle-o"></i>Agregar Trabajadores</a></li>
                  <li><a href="{{url('trabajadores')}}"><i class="fa fa-circle-o"></i>Administrar Trabajadores</a></li>
                </ul>
              </li>
            @endif
            @if(Auth::user()->nivel != 3)
              <li class="treeview">
                <a href="#">
                  <i class="fa fa-user"></i> <span>Soporte</span>
                  <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li><a href="{{url('soportes/create')}}"><i class="fa fa-circle-o"></i>Agregar Soporte</a></li>
                  <li><a href="{{url('soportes')}}"><i class="fa fa-circle-o"></i>Administración de Soporte</a></li>
                </ul>
              </li>
              @if(Auth::user()->nivel != 1)
              <li class="treeview">
                <a href="#">
                  <i class="fa fa-file"></i> <span>Tareas</span>
                  <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li><a href="{{url('tareas')}}"><i class="fa fa-circle-o"></i>Ver Tareas</a></li>
                  <li><a href="{{url('soportes/ver_reportes')}}"><i class="fa fa-circle-o"></i>Ver reportes creados</a></li>
                </ul>
              </li>
              @endif
            @endif
            @if(Auth::user()->nivel == 1)
              <li class="treeview">
                <a href="#">
                  <i class="fa fa-users"></i>
                  <span>Usuarios</span>
                  <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li><a href="{{url('usuarios/create') }}"><i class="fa fa-circle-o"></i> Registrar usuarios</a></li>
                  <li><a href="{{url('usuarios')}}"><i class="fa fa-circle-o"></i> Ver usuarios</a></li>
                </ul>
              </li>
            @endif
             <li class="treeview">
              <a href="#">
                <small class="label bg-red">PDF</small> <span>Informes</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{url('pdf/equipos') }}"><i class="fa fa-circle-o"></i> Informe por equipos</a></li>
                <li><a href="{{url('pdf/departamentos') }}"><i class="fa fa-circle-o"></i> Informe por departamentos</a></li>
                <li><a href="{{url('pdf/fallas') }}"><i class="fa fa-circle-o"></i> Informe de Fallas</a></li>
              </ul>
            </li>
            <li>
              <a href="{{ url('correspondencia') }}">
                 <small class="label bg-yellow"><i class="fa fa-envelope"></i></small><span>Correspondecia</span>
              </a>
            </li>
                        
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
       <!--Contenido TODO LO DE EL MEDIO -->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Sistema </h3>
                  
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  	<div class="row">
	                  	<div class="col-md-12">
		                          <!--Contenido-->
                              @yield('contenido')
		                          <!--Fin Contenido-->
                           </div>
                        </div>
		                    
                  		</div>
                  	</div><!-- /.row -->
                </div><!-- /.box-body -->
              </div><!-- /.box -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <!--Fin-Contenido-->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 2.3.0
        </div>
        <strong>Copyright &copy;  <a href="www.google.co.ve">Google</a>.</strong> All rights reserved.
        <!-- jQuery 2.1.4 -->
        <script src="{{ asset('js/jQuery-2.1.4.min.js') }}"></script>
        <!-- Bootstrap 3.3.5 -->
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <!-- AdminLTE App --> 
        <script src="{{ asset('js/app.min.js') }}"></script>
        <!--Datatables -->
        <script src="{{ asset('plugins/datatables/jquery.dataTables.js') }}"></script>
        <script src="{{ asset('plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
        @yield('script')
      </footer>
  </body>
</html>



