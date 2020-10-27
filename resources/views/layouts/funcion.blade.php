<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ 'Sistema de Control de Avance y Asistencia'}}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>



    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app" style="background-color: #006699;" >
        <div class="container">
            <div class="row">
                <div class="col-lg-2" style="background-color: #006699;"><{{ asset('umss.png') }}"></div>
                <div class="col offset-lg-0" style="background-color: #006699;"><input class="form-control-plaintext" type="text" value="UNIVERSIDAD MAYOR DE SAN SIMON" readonly="" style="font-family: Arial;font-size: 25px;color: rgb(233,237,241);background-color: #006699;padding: 20px;"></div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-2" style="background-color: #006699;"></div>
                <div class="col offset-lg-0" style="background-color: #006699;"><input class="form-control-plaintext" type="text" value="SISTEMA DE CONTROL DE ASISTENCIA Y AVANCE" readonly="" style="font-family: Arial;font-size: 25px;color: rgb(233,237,241);background-color: #006699;padding: 20px;"></div>
            </div>
        </div>

        <div class="container" style="background-color: #262d31;">
            <div class="row">
            <div class="col-xl-1"><a href="{{url('principal')}}" style="color: rgb(228,231,235);">INICIO</a></div>
            <div class="col-xl-1"><a href="{{ url()->previous() }}" style="color: rgb(255,255,255);">ATRAS</a></div>
            <div class="col"><input class="form-control-plaintext" type="text" readonly=""></div>
            <!--div class="col-xl-2"><input class="form-control-plaintext" type="text" value="{{ Auth::user()->nombres }} {{ Auth::user()->apellidos }}" readonly="" style="color: rgb(255,255,255);">  <-->
            <div class="col-xl-2"><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="color: rgb(255,255,255);">CERRAR SESION</a>
                   
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>

            
            </div>
                
        </div>  
            
                

            
        </div>

        <div class="container">
            <div class="row">
                <div class="col"><input class="form-control-plaintext" type="text" value="ADMINISTRADOR - {{ Auth::user()->nombres }} {{ Auth::user()->apellidos }}" readonly="" style="color: #ffffff;font-size: 20px;"></div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col"><a href="{{url('facultad')}}" style="color: rgb(255,255,255);">FACULTADES</a></div>
                <div class="col"><a href="{{url('departamento')}}" style="color: rgb(255,255,255);">DEPARTAMENTOS</a></div>
                <div class="col"><a href="{{url('materia')}}" style="color: #ffffff;">MATERIAS</a></div>
                <div class="col"><a href="{{url('user')}}" style="color: #ffffff;">USUARIOS</a></div>
                <div class="col"><a href="{{url('role')}}" style="color: #ffffff;">ROLES</a></div>
                <div class="col"><a href="{{url('asignacion')}}" style="color: #ffffff;">ASIGNACIONES</a></div>
                <div class="col"><a href="{{url('carrera')}}" style="color: #ffffff;">CARRERAS</a></div>
                <div class="col"><a href="{{url('gestion')}}" style="color: #ffffff;">GESTIONES</a></div>
            </div>
            <div class="col"><input class="form-control-plaintext" type="text" readonly=""></div>
            <div class="col-lg-2" style="background-color: #006699;"><img src="{{ asset('fondo.png') }}"></div>
        </div>
        

        <main class="py-4">
            @yield('content')
        </main>
        
    </div>
    <div id="derechos" style="background-color: #006699;" >
        <div class="container" style="background-color: #262d31;">
            <div class="row">
                <div class="col-lg-2" style="background-color: #262d31;"></div>
                <div class="col offset-lg-0" style="background-color: #262d31;"><input class="form-control-plaintext" type="text" value="© 2020  - DIGITAL STRATEGIES " readonly="" style="font-family: Arial;font-size: 20px;color: rgb(233,237,241);background-color: #262d31;padding: 20px;"></div>
                </div>
        </div>
    </div>
    
</body>
</html>
