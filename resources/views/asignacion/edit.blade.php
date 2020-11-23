@extends('layouts.principal')

@section('content')

<div class="container">

    <div class="container" >
        <div class="row justify-content-center" >
            <div class="col-md-8">
                <div class="card" style="width: 24rem; background-color: #a3bcc9;">


    <h1 class="text-center" style="font-family: Arial;font-size: 25px;color: rgb(0, 0, 0);" >Editar asignacion</h1>

<form action="{{url('/asignacion/'.$asi->id)}}"  class= "form-horizontal" style="font-family: Arial;color: rgb(0, 0, 0);" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{method_field('PATCH')}}

    <label for="">Actual</label>
    <br/>
    <label >{{ 'Gestion : ' }}</label>
    <label>{{$asi->gestion}}</label>
    <br/>
    <label >{{ 'Departamento : ' }}</label>
    <label >{{$asi->departamento}}</label>
    <br/>
    <label >{{ 'Docente : ' }}</label>
    <label >{{$asi->docente}}</label>
    <br/>
    <label>{{ 'Materia : ' }}</label>
    <label >{{$asi->materia}}</label>
    <br/>
    <label>{{ 'Grupos : ' }}</label>
    <label >{{$asi->grupo}}</label>
    <br/>
    <label>{{ 'Horario : ' }}</label>
    <label >{{$asi->horario}}</label>
    <br/>
    
    <br/>
    <br/>

    <label for="">Modificar datos</label>
    <br/>
    <div class="form-group">
        <label for="exampleFormControlSelect1">Gestión</label>
        <select name="gestion" class="form-control" id="gestion">
            @foreach ($gestiones as $item)
                <option value="{{$item->gestion}}">{{$item->gestion}}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="exampleFormControlSelect1">Departamento</label>
        <select name="departamento"  value="" class="form-control" id="departamento">
        @foreach ($departamentos as $item)
            <option value="{{$item->nombredepa}}">{{$item->nombredepa}}</option>
        @endforeach
    </select>
    </div>

    <div class="form-group">
        <label for="exampleFormControlSelect1">Docente</label>
        <select name="docente" class="form-control" id="docente">
            @foreach ($docentes as $item)
                <option value="{{$item->id}}">{{$item->nombres}} {{$item->apellidos}}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
    <label for="materia">Materia</label>
    <select name="materia" class="form-control" id="materia">
        <option value="-">--Seleccionar--</option>
        @foreach ($materias as $key => $value)
                <option value="{{$key}}">{{$value}}</option>
            @endforeach
    </select>
    </div>

    <div class="form-group">
        <label for="grupo">Grupo</label>
        <select name="grupo" class="form-control" id="grupo">
            
        </select>
    </div>

    <div class="form-group">
        <label for="horario">Horario</label>
        <select name="horario" class="form-control" id="horario">
            
        </select>
    </div>

    <input type="submit" class="btn btn-success" value="Guardar cambios">
    <a class="btn btn-danger" href="{{url('asignacion')}}">Cancelar</a>


</form>

</div>
</div>
</div>
</div>

</div>

<script type=text/javascript>
    $('#materia').change(function(){
    var countryID = $(this).val();  
    if(countryID){
      $.ajax({
        type:"GET",
        url: 'getgroups/' +countryID,
        dataType : "json",
        success:function(res){        
        if(res){
          $("#grupo").empty();
          $("#grupo").append('<option>--Seleccionar--</option>');
          $.each(res,function(key,value){
            $("#grupo").append('<option value="'+key+'">'+value+'</option>');
          });
        
        }else{
          $("#grupo").empty();
        }
        }
      });
    }else{
      $("#grupo").empty();
      $("#horario").empty();
    }   
    });
    $('#grupo').on('change',function(){
    var stateID = $(this).val();  
    if(stateID){
      $.ajax({
        type:"GET",
        url: 'gethorarios/' +stateID,
        dataType : "json",
        success:function(res){        
        if(res){
          $("#horario").empty();
          $.each(res,function(key,value){
            $("#horario").append('<option value="'+key+'">'+value+'</option>');
          });
        
        }else{
          $("#horario").empty();
        }
        }
      });
    }else{
      $("#horario").empty();
    }
      
    });
  </script>
@endsection