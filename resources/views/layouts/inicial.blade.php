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

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app" style="background-color: #006699;" >
        <div class="container">
            <div class="row">
                <div class="col-lg-2" style="background-color: #006699;"><img src="{{ asset('umss.png') }}"></div>
                <div class="col offset-lg-0" style="background-color: #006699;"><input class="form-control-plaintext" type="text" value="UNIVERSIDAD MAYOR DE SAN SIMON" readonly="" style="font-family: Arial;font-size: 25px;color: rgb(233,237,241);background-color: #006699;padding: 20px;"></div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-2" style="background-color: #006699;"></div>
                <div class="col offset-lg-0" style="background-color: #006699;"><input class="form-control-plaintext" type="text" value="SISTEMA DE CONTROL DE ASISTENCIA Y AVANCE" readonly="" style="font-family: Arial;font-size: 25px;color: rgb(233,237,241);background-color: #006699;padding: 20px;"></div>
            </div>
        </div>
        

        <main class="py-4">
            @yield('content')
        </main>
        
    </div>
    <div id="derechos" style="background-color: #006699;" >
    <div class="container">
        <div class="row">
            <div class="col-lg-2" style="background-color: #006699;"></div>
            <div class="col offset-lg-0" style="background-color: #006699;"><input class="form-control-plaintext" type="text" value="© 2020  - DIGITAL STRATEGIES " readonly="" style="font-family: Arial;font-size: 20px;color: rgb(233,237,241);background-color: #006699;padding: 20px;"></div>
            </div>
    </div>
    </div>
    
</body>
</html>
