<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>SISTEMA DE CONTROL DE AVANCE Y ASISTENCIA</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    SISTEMA DE CONTROL DE AVANCE Y ASISTENCIA
                </div>

                <div class="links">

                    
                </div>

                <table class="table table-light">
                    <thead class="thead-light">
                        <tr>
                
                            <th> <a href="{{url('user')}}">Usuarios</a> </th>
                            <th><a href="{{url('facultad')}}">Facultad</a></th>
                            <th><a href="{{url('departamento')}}">Departamento</a></th>
                            <th><a href="{{url('carrera')}}">Carrera</a></th>
                            <th><a href="{{url('materia')}}">Materia</a></th>
                            <th><a href="{{url('gestion')}}">Gestion</a></th>
                            <th><a href="{{url('asignacion')}}">Asignacion</a></th>
                        </tr>
                    </thead>

                </table>

            </div>
        </div>
    </body>
</html>
