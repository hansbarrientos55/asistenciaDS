@extends('layouts.principal')

@section('content')

<div class="container">

    <div class="container" >
        <div class="row justify-content-center" >
            <div class="col-md-8">
                <div class="card" style="width: 24rem; background-color: #a3bcc9;">
                <h1 class="text-center" style="font-family: Arial;font-size: 25px;color: rgb(0, 0, 0);" >Crear reposicion de clase</h1>

                <form action="{{url('reposicion/store/'.$id)}}" class= "form-horizontal" style="font-family: Arial;color: rgb(0, 0, 0);" method="post"  enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="fecha" class="control-label">{{ 'Fecha' }}</label>
                    <input class="form-control" type="string" name="fecha" id="fecha" value="{{$fecha}}" required readonly>
                    </div>  
                
                    <div class="form-group">
                        <label for="hora" class="control-label">{{ 'Hora' }}</label>
                        <input class="form-control" type="string" name="hora" id="hora" value="{{ $hora }}" required readonly>
                    </div> 

                    <div class="form-group">
                        <label for="nuevafecha" class="control-label">{{ 'Nueva fecha' }}</label>
                        <input class="form-control" type="date" name="nuevafecha" id="nuevafecha" value="" required>
                        </div>

                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Horario</label>
                        <select name="horario" class="form-control" id="horario">
                            @foreach ($horarios as $item)
                                <option value="{{$item->hora}}">{{$item->hora}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Grupo</label>
                        <select name="grupo" class="form-control" id="grupo">
                            @foreach ($grupos as $item)
                                <option value="{{$item->numerogrupo}}">{{$item->numerogrupo}}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Materia</label>
                        <select name="materia" class="form-control" id="materia">
                            @foreach ($materias as $item)
                                <option value="{{$item->nombremate}}">{{$item->nombremate}}</option>
                            @endforeach
                        </select>
                    </div>

                    @role('Docente')
                    <div class="form-group">
                        <label for="estado" class="control-label">Estado de la reposicion</label>
                        <input class="form-control" type="text" name="estado" id="estado" value="Esperando confirmacion" readonly required>
                    </div> 
                    @endrole
                  

                    <input type="submit" class="btn btn-success" value="Guardar">
                    <a class="btn btn-danger" href="{{url()->previous()}}">Cancelar</a>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection