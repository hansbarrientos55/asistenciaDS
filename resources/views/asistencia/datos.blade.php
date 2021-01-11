@extends('layouts.principal')

@section('content')

<div class="container">

    <div class="container" >
        <div class="row justify-content-center" >
            <div class="col-md-8">
                <div class="card" style="width: 24rem; background-color: #a3bcc9;">
                <h1 class="text-center" style="font-family: Arial;font-size: 25px;color: rgb(0, 0, 0);" >Nueva asistencia</h1>

                <form action="{{url('asistenciaguardar')}}" class= "form-horizontal" style="font-family: Arial;color: rgb(0, 0, 0);" method="post"  enctype="multipart/form-data">
                    @csrf
                    
                    @if($errors->first('tipo'))
                    <div class="alert alert-danger" role ="alert" >
                    <ul>
                            <li>{{ $errors->first('tipo')}} </li>
                    </ul>
                    </div>
                    <a class="btn btn-danger" href="{{url('asistencia')}}">Volver a asistencias</a>
                    @else

                    <input class="form-control" type="string" name="user_id" id="user_id" value="{{$user_id}}" required hidden>
                    
                    <div class="form-group">
                        <label for="materia" class="control-label">Materia</label>
                        <input class="form-control" type="string" name="materia" id="materia" value="{{$materia}}" required hidden>
                        <input class="form-control" type="string" name="nombremateria" id="nombremateria" value="{{$nombremateria}}" required readonly>
                    </div>  

                    <div class="form-group">
                        <label for="materia" class="control-label">Grupo</label>
                        <input class="form-control" type="string" name="grupo" id="grupo" value="{{$grupo}}" required hidden>
                        <input class="form-control" type="string" name="nombregrupo" id="nombregrupo" value="{{$nombregrupo}}" required readonly>
                    </div>  

                    <div class="form-group">
                        <label for="materia" class="control-label">Horario</label>
                        <input class="form-control" type="string" name="horario" id="horario" value="{{$horario}}" required hidden>
                        <input class="form-control" type="string" name="titulohorario" id="titulohorario" value="{{$titulohorario}}" required readonly>
                    </div> 
                    
                    <div class="form-group">
                        <label for="fecha" class="control-label">{{ 'Fecha' }}</label>
                    <input class="form-control" type="string" name="fecha" id="fecha" value="{{$fecha}}" required readonly>
                    </div>  
                
                    <div class="form-group">
                        <label for="hora" class="control-label">{{ 'Hora' }}</label>
                        <input class="form-control" type="string" name="hora" id="hora" value="{{ $hora }}" required readonly>
                    </div>  

                    <div class="form-group">
                        <label for="mes" class="control-label">{{ 'Mes' }}</label>
                        <input class="form-control" type="string" name="mes" id="mes" value="{{ $mes }}" required readonly>
                    </div> 

                    <div class="form-group">
                        <label for="iniciosemana" class="control-label">{{ 'Inicio semana' }}</label>
                        <input class="form-control" type="string" name="iniciosemana" id="iniciosemanas" value="{{ $iniciosemana }}" required readonly>
                    </div> 

                    <div class="form-group">
                        <label for="finsemana" class="control-label">{{ 'Fin semana' }}</label>
                        <input class="form-control" type="string" name="finsemana" id="finsemana" value="{{ $finsemana }}" required readonly>
                    </div> 

                    <div class="form-group">
                        <label for="tipo" class="control-label">Tipo de clase</label>
                        <select name="tipo"  value="" class="form-control" id="tipo">
                            <option value="Normal">Normal</option>
                            <option value="Reposicion">Reposicion</option>
                    
                    </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="contenido" class="control-label">Contenido de la clase</label>
                        <input class="form-control" type="text" name="contenido" id="contenido" value="" required>
                    </div>  
                
                    <label for="plataforma" class="control-label">Plataforma o medio utilizado</label>

                    <div class="form-group">
                        <label for="repositorio" class="control-label">Repositorio</label>
                        <select name="repositorio"  value="" class="form-control" id="repositorio">
                            <option value="Google Drive">Google Drive</option>
                        </select>    
                    </div>  

                    <div class="form-group">
                        <label for="notificacion" class="control-label">Notificacion</label>
                        <select name="notificacion"  value="" class="form-control" id="notificacion">
                            <option value="Gmail">Gmail</option>
                            <option value="Whatsapp">Whatsapp</option>
                            <option value="Telegram">Telegram</option>
                        </select>    
                    </div> 

                    <div class="form-group">
                        <label for="claseonline" class="control-label">Clase online</label>
                        <select name="claseonline"  value="" class="form-control" id="claseonline">
                            <option value="Google Classroom">Google Classroom</option>
                            <option value="Zoom">Zoom</option>
                        </select>    
                    </div> 

                    <div class="form-group">
                        <label for="obervaciones" class="control-label">Observaciones</label>
                        <input class="form-control" type="text" name="observaciones" id="observaciones" value="" required>
                    </div>  
                
                    <div class="form-group">
                        <label for="firma" class="control-label">Firma</label>
                        <input class="form-control" type="text" name="firma" id="firma" value="" required>
                    </div> 

                    <div class="form-group">
                        <label for="archivo" class="control-label">Archivo</label>
                        <input class="form-control" type="file" name="archivo" id="archivo" value="">
                    </div> 

                    @hasrole('Auxiliar de Docencia')
                    <div class="form-group">
                        <label for="grabacion" class="control-label">Enlace de la grabacion</label>
                        <input class="form-control" type="text" name="grabacion" id="grabacion" value="" required>
                    </div> 
                    @endrole

                    @hasrole('Auxiliar de Laboratorio')
                    <div class="form-group">
                        <label for="tarea" class="control-label">Tarea</label>
                        <input class="form-control" type="text" name="tarea" id="tarea" value="" required>
                    </div> 
                    @endrole

                   

                    <input type="submit" class="btn btn-success" value="Guardar">
                    <a class="btn btn-danger" href="{{url('asistencia')}}">Cancelar</a>
                @endif
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection