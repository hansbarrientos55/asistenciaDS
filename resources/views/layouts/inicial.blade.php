<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=divice-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ 'Sistema de Control de Avance y Asistencia'}}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app" style="background-color: #a3bcc9;">
        <div>
            <div class="row">
                <div class="col-sm-12 col-md-5" style="background-color: #006699;" ><img src="{{ asset('escudoUmss.png') }}" width="100%" ></div>
                <div class="col-sm-12 col-md-7" style="background-color: #006699;">
                    <div style="font-family: Arial;font-size: 25px;color: rgb(233,237,241);background-color: #006699;padding: 20px; height:100%; display:flex; align-items:center;"> <span>SISTEMA DE CONTROL DE ASISTENCIA Y AVANCE</span>  </div>
                </div>
            </div>
        </div>
        <main class="py-4">
            @yield('content')
        </main>
        
    </div>
    <div id="derechos" style="background-color: #006699;" >
        <div class="row justify-content-md-center"> 
            <div class="col-12" style="background-color: #006699;text-align:center; padding: 20px;">
                <span  style="font-family: Arial;font-size: 20px;color: rgb(233,237,241);background-color: #006699;">© 2020  - DIGITAL STRATEGIES </span>
            </div>
        </div>
    </div>
    
</body>
</html>
