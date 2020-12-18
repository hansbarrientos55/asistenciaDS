@extends('layouts.principal')

@section('content')

<div class="container">

    <div class="container">
        <br/>
        <h2 class="text-center" style="font-family: Arial;font-size: 25px;color: rgb(0, 0, 0);" >Nuevo evento</h2>


        <form method="post" action="{{url('event/add')}}">
          @csrf
          <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
              <label for="Title">Titulo</label>
              <input type="text" class="form-control" name="title">
            </div>
          </div>
          <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
              <label> Fecha de inicio : </label>  
              <input class="form-control"  type="date" id="startdate" name="startdate">   
           </div>
          </div>
          <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
              <label> Fecha de finalizacion : </label>  
              <input class="form-control"  type="date" id="enddate" name="enddate">   
           </div>
          </div>
          <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
              <button type="submit" class="btn btn-success">Agregar</button>
              <input class="btn btn-primary" type="reset" value="Limpiar campos">
              <a class="btn btn-danger" href="{{url('event')}}">Cancelar</a>
            </div>
          </div>
        </form>
      </div>
      <script type="text/javascript">  
          $('#startdate').datepicker({ 
              autoclose: true,   
              format: 'yyyy-mm-dd'  
           });
           $('#enddate').datepicker({ 
              autoclose: true,   
              format: 'yyyy-mm-dd'
           }); 
      </script>

</div>
@endsection