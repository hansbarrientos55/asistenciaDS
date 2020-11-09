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
    <div id="app" style="background-color: #a3bcc9;" >
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

        <div class="container" style="background-color: #274453;">
            <div class="row">
            <div class="col-xl-1"><a href="{{url('principal')}}" style="color: rgb(255, 255, 255);"> <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-house-door-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path d="M6.5 10.995V14.5a.5.5 0 0 1-.5.5H2a.5.5 0 0 1-.5-.5v-7a.5.5 0 0 1 .146-.354l6-6a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 .146.354v7a.5.5 0 0 1-.5.5h-4a.5.5 0 0 1-.5-.5V11c0-.25-.25-.5-.5-.5H7c-.25 0-.5.25-.5.495z"/>
                <path fill-rule="evenodd" d="M13 2.5V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
              </svg> INICIO</a></div>
            <div class="col-xl-1"><a href="{{ url()->previous() }}" style="color: rgb(255, 255, 255);"><svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-arrow-left-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.5.5a.5.5 0 0 0 0-1H5.707l2.147-2.146a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708-.708L5.707 8.5H11.5z"/>
              </svg> ATRAS</a></div>
            <div class="col"><input class="form-control-plaintext" type="text" readonly=""></div>
            <div class="col-xl-2"><input class="form-control-plaintext" type="text" value="{{ Auth::user()->nombres }} {{ Auth::user()->apellidos }}" readonly="" style="color: rgb(255,255,255);"></div>
            <div class="col-xl-2"><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="color: rgb(255, 255, 255);"><svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-door-open-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M1.5 15a.5.5 0 0 0 0 1h13a.5.5 0 0 0 0-1H13V2.5A1.5 1.5 0 0 0 11.5 1H11V.5a.5.5 0 0 0-.57-.495l-7 1A.5.5 0 0 0 3 1.5V15H1.5zM11 2v13h1V2.5a.5.5 0 0 0-.5-.5H11zm-2.5 8c-.276 0-.5-.448-.5-1s.224-1 .5-1 .5.448.5 1-.224 1-.5 1z"/>
              </svg> CERRAR SESION</a>
                   
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>

            
            </div>
                
        </div>  
            
                

            
        </div>

        <div class="container " style="background-color: #274453;">
            <div class="row">
                <div class="col"><input class="form-control-plaintext" type="text" value="{{ Auth::user()->roles->implode('name',' , ') }}" readonly="" style="color: #ffffff;font-size: 20px;"></div>
            </div>
        </div>
        <div class="container " style="background-color: #274453;">
            <div class="row">
                  @role('Administrador')
                  <div class="col"><a href="{{url('/configuracion')}}" style="color: rgb(255, 255, 255);"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-tools" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M0 1l1-1 3.081 2.2a1 1 0 0 1 .419.815v.07a1 1 0 0 0 .293.708L10.5 9.5l.914-.305a1 1 0 0 1 1.023.242l3.356 3.356a1 1 0 0 1 0 1.414l-1.586 1.586a1 1 0 0 1-1.414 0l-3.356-3.356a1 1 0 0 1-.242-1.023L9.5 10.5 3.793 4.793a1 1 0 0 0-.707-.293h-.071a1 1 0 0 1-.814-.419L0 1zm11.354 9.646a.5.5 0 0 0-.708.708l3 3a.5.5 0 0 0 .708-.708l-3-3z"/>
                    <path fill-rule="evenodd" d="M15.898 2.223a3.003 3.003 0 0 1-3.679 3.674L5.878 12.15a3 3 0 1 1-2.027-2.027l6.252-6.341A3 3 0 0 1 13.778.1l-2.142 2.142L12 4l1.757.364 2.141-2.141zm-13.37 9.019L3.001 11l.471.242.529.026.287.445.445.287.026.529L5 13l-.242.471-.026.529-.445.287-.287.445-.529.026L3 15l-.471-.242L2 14.732l-.287-.445L1.268 14l-.026-.529L1 13l.242-.471.026-.529.445-.287.287-.445.529-.026z"/>
                  </svg> CONFIGURACION</a></div>
                  @endrole

                  @role('Administrador')
                  <div class="col"><a href="{{url('facultad')}}" style="color: rgb(255, 255, 255);"><svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-menu-button-wide-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M14 7H2a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V8a1 1 0 0 0-1-1zM2 6a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2H2z"/>
                    <path fill-rule="evenodd" d="M15 11H1v-1h14v1zM2 12.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM1.5 0A1.5 1.5 0 0 0 0 1.5v2A1.5 1.5 0 0 0 1.5 5h13A1.5 1.5 0 0 0 16 3.5v-2A1.5 1.5 0 0 0 14.5 0h-13zm1 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1h-3zm9.927.427l.396.396a.25.25 0 0 0 .354 0l.396-.396A.25.25 0 0 0 13.396 2h-.792a.25.25 0 0 0-.177.427z"/>
                  </svg> FACULTADES</a></div>
                  @endrole
                  
                  @role('Administrador')
                  <div class="col"><a href="{{url('departamento')}}" style="color: rgb(255, 255, 255);"><svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-file-richtext-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM7 4.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0zm-.861 1.542l1.33.886 1.854-1.855a.25.25 0 0 1 .289-.047l1.888.974V7.5a.5.5 0 0 1-.5.5H5a.5.5 0 0 1-.5-.5V7s1.54-1.274 1.639-1.208zM5 9a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1H5zm0 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1H5z"/>
                  </svg> DEPARTAMENTOS</a></div>
                  @endrole
                  
                  @role('Administrador')
                  <div class="col"><a href="{{url('materia')}}" style="color: #ffffff;"><svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-newspaper" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M0 2.5A1.5 1.5 0 0 1 1.5 1h11A1.5 1.5 0 0 1 14 2.5v10.528c0 .3-.05.654-.238.972h.738a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 1 1 0v9a1.5 1.5 0 0 1-1.5 1.5H1.497A1.497 1.497 0 0 1 0 13.5v-11zM12 14c.37 0 .654-.211.853-.441.092-.106.147-.279.147-.531V2.5a.5.5 0 0 0-.5-.5h-11a.5.5 0 0 0-.5.5v11c0 .278.223.5.497.5H12z"/>
                    <path d="M2 3h10v2H2V3zm0 3h4v3H2V6zm0 4h4v1H2v-1zm0 2h4v1H2v-1zm5-6h2v1H7V6zm3 0h2v1h-2V6zM7 8h2v1H7V8zm3 0h2v1h-2V8zm-3 2h2v1H7v-1zm3 0h2v1h-2v-1zm-3 2h2v1H7v-1zm3 0h2v1h-2v-1z"/>
                  </svg> MATERIAS</a></div>
                  @endrole
                  
                  @role('Administrador')
                  <div class="col"><a href="{{url('user')}}" style="color: #ffffff;"> <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-person-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M13.468 12.37C12.758 11.226 11.195 10 8 10s-4.757 1.225-5.468 2.37A6.987 6.987 0 0 0 8 15a6.987 6.987 0 0 0 5.468-2.63z"/>
                    <path fill-rule="evenodd" d="M8 9a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                    <path fill-rule="evenodd" d="M8 1a7 7 0 1 0 0 14A7 7 0 0 0 8 1zM0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8z"/>
                  </svg> USUARIOS</a></div>
                  @endrole
                  
                  @role('Administrador')
                  <div class="col"><a href="{{url('rango')}}" style="color: #ffffff;"><svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-people" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8zm-7.978-1h7.956a.274.274 0 0 0 .014-.002l.008-.002c-.002-.264-.167-1.03-.76-1.72C13.688 10.629 12.718 10 11 10c-1.717 0-2.687.63-3.24 1.276-.593.69-.759 1.457-.76 1.72a1.05 1.05 0 0 0 .022.004zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0zM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816zM4.92 10c-1.668.02-2.615.64-3.16 1.276C1.163 11.97 1 12.739 1 13h3c0-1.045.323-2.086.92-3zM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4z"/>
                  </svg> ROLES</a></div>
                  @endrole
                  
                  @role('Jefe de Departamento')
                  <div class="col"><a href="{{url('asignacion')}}" style="color: #ffffff;"><svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-list-task" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M2 2.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5V3a.5.5 0 0 0-.5-.5H2zM3 3H2v1h1V3z"/>
                    <path d="M5 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM5.5 7a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1h-9zm0 4a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1h-9z"/>
                    <path fill-rule="evenodd" d="M1.5 7a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H2a.5.5 0 0 1-.5-.5V7zM2 7h1v1H2V7zm0 3.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5H2zm1 .5H2v1h1v-1z"/>
                  </svg> ASIGNACIONES</a></div>
                  @endrole
                  
                  @role('Administrador')
                  <div class="col"><a href="{{url('carrera')}}" style="color: #ffffff;"><svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-book-half" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M8.5 2.687v9.746c.935-.53 2.12-.603 3.213-.493 1.18.12 2.37.461 3.287.811V2.828c-.885-.37-2.154-.769-3.388-.893-1.33-.134-2.458.063-3.112.752zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z"/>
                  </svg> CARRERAS</a></div>
                  @endrole
              
                  @role('Administrador')
                  <div class="col"><a href="{{url('gestion')}}" style="color: #ffffff;"><svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-calendar-event-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4V.5zM16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2zm-3.5-7a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1z"/>
                  </svg> GESTIONES</a></div>
                  @endrole
            
                </div>

            </div>
        

        <main class="py-4">
            @yield('content')
        </main>
        
    </div>
    <div id="derechos" style="background-color: #006699;" >
        <div class="container" style="background-color: #006699;">
            <div class="row">
                <div class="col-lg-2" style="background-color: #006699;"></div>
                <div class="col offset-lg-0" ><input class="form-control-plaintext" type="text" value="© 2020  - DIGITAL STRATEGIES " readonly="" style="font-family: Arial;font-size: 20px;color: rgb(233,237,241);background-color: #006699;padding: 20px;"></div>
                </div>
        </div>
    </div>
    
</body>
</html>
