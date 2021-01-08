@extends('layouts.inicial')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        
        
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <p class="text-center" style="font-size:24px;margin-top:50px;font-weight:bold;">Esta aplicacion ayuda al control de la asistencia</p>
                        <p class="text-center" style="font-size:24px;margin-top:35px;font-weight:bold;">de los Docentes y Auxiliares de la UMSS</p>
                        <p class="text-center" style="font-size:24px;margin-top:35px;font-weight:bold;">Su alcance es a nivel facultades, departamentos, carreras</p>
                        <p class="text-center" style="font-size:24px;margin-top:35px;font-weight:bold;">Con un entorno de trabajo facil e intuitivo</p>
                    
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            
                            <div class="card-body" style="font-family: Arial;font-size: 18px;color: rgb(255, 255, 255);background-color: #274453;">
                                <a href="{{url('login')}}" style="color: rgb(255, 255, 255);"> 
                                    <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-house-door-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.5 10.995V14.5a.5.5 0 0 1-.5.5H2a.5.5 0 0 1-.5-.5v-7a.5.5 0 0 1 .146-.354l6-6a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 .146.354v7a.5.5 0 0 1-.5.5h-4a.5.5 0 0 1-.5-.5V11c0-.25-.25-.5-.5-.5H7c-.25 0-.5.25-.5.495z"/>
                                    <path fill-rule="evenodd" d="M13 2.5V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
                                  </svg> Ingresar al sistema </a>
                            </div>
                        </div>
                        <div class="card">
                            
                            <div class="card-body" style="font-family: Arial;font-size: 18px;color: rgb(255, 255, 255);background-color: #274453;">
                                <a href="mailto:controlasistencia@fcyt.umss.bo" style="color: rgb(255, 255, 255);"> 
                                    <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">
                                        <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555zM0 4.697v7.104l5.803-3.558L0 4.697zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757zm3.436-.586L16 11.801V4.697l-5.803 3.546z"/>
                                      </svg> Contacto </a>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
