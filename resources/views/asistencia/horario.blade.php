@extends('layouts.principal')

@section('content')

<div class="container">

    <div class="container" >
        <div class="row justify-content-center" >
            <div class="col-md-8">
                <div class="card" style="width: 24rem; background-color: #a3bcc9;">
                <h1 class="text-center" style="font-family: Arial;font-size: 25px;color: rgb(0, 0, 0);" >Nueva asistencia</h1>

                <form action="{{url('asistenciadatos')}}" class= "form-horizontal" style="font-family: Arial;color: rgb(0, 0, 0);" method="post"  enctype="multipart/form-data">
                    @csrf

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
                        <label for="exampleFormControlSelect1">Horario</label>
                        <select name="horario" class="form-control" id="horario">
                            @foreach ($horarios as $item)
                                <option value="{{$item->id}}">{{$item->titulo}}</option>
                            @endforeach
                        </select>
                    </div>

                    <input type="submit" class="btn btn-success" value="Siguiente">
                    <a class="btn btn-danger" href="{{url('asistencia')}}">Cancelar</a>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection