@extends('layouts.principal')

@section('content')

<div class="container">

    <div class="container" >
        <div class="row justify-content-center" >
            <div class="col-md-8">
                <div class="card" style="width: 24rem; background-color: #a3bcc9;">


    <h1 class="text-center" style="font-family: Arial;font-size: 25px;color: rgb(0, 0, 0);" >Editar grupo</h1>

<form action="{{url('/asignacion/editar/guardar/'.$llave)}}"  class= "form-horizontal" style="font-family: Arial;color: rgb(0, 0, 0);" method="post" enctype="multipart/form-data">
    @csrf
    

    <label for="">Modificar datos</label>
    <br/>
     <div class="form-group">
            <label for="exampleFormControlSelect1">Gestión</label>
             <input class="form-control" type="hidden" id="llave" name="llave" value="{{$llave}}">
              <input class="form-control" type="text" name="gestion" id="gestion" value="{{$gestion}}" readonly required>
        </div>

        <div class="form-group">
            <label for="exampleFormControlSelect1">Departamento</label>
            <input class="form-control" type="text" name="departamento" id="departamento" value="{{$departamento}}" readonly required>
        </div>

        <div class="form-group">
            <label for="exampleFormControlSelect1">Docente</label>
            <input class="form-control" type="text" name="nomdocente" id="nomdocente" value="{{$nomdocente}}" readonly required>
            <input class="form-control" type="hidden" id="docente" name="docente" value="{{$docente}}">
        </div>

        <div class="form-group">
        <label for="materia">Materia</label>
        <input class="form-control" type="text" name="nommateria" id="nommateria" value="{{$nommateria}}" readonly required>
        <input class="form-control" type="hidden" id="materia" name="materia" value="{{$materia}}">
        </div>

        <div class="form-group">
            <label for="exampleFormControlSelect1">Grupo</label>
            <select name="grupo" class="form-control" id="grupo">
                @foreach ($grupos as $item)
                    <option value="{{$item->id}}">{{$item->numerogrupo}}</option>
                @endforeach
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