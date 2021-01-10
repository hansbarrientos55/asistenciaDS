@extends('layouts.principal')

@section('content')

<div class="container">

  <div class="container" >
    <div class="row justify-content-center" >
        <div class="col-md-8">
            <div class="card" style="width: 20rem; background-color: #a3bcc9;">
        <h2 class="text-center" style="font-family: Arial;font-size: 25px;color: rgb(0, 0, 0);" >Nuevo evento</h2>
        <form method="post" action="{{url('event/add')}}">
          @csrf

          @if($errors->first('title'))
          <div class="alert alert-danger" role ="alert" >
            <ul>
                      <li>{{ $errors->first('title')}} </li>
            </ul>
          </div>
          @endif

          <div class="form-group">


              <label for="Title">Titulo</label>
              <input type="text" class="form-control" name="title" value="{{ old('title') }}" required>
              <input class="form-control" type="text" name="creator" id="creator" value="" hidden>

          </div>
          <div class="form-group">


              <label> Fecha de inicio </label>  
              <input class="form-control"  type="date" id="start" name="start" value="{{ old('start') }}" required>   

          </div>
          <div class="form-group">


              <label> Fecha de finalizacion </label>  
              <input class="form-control"  type="date" id="end" name="end" value="{{ old('end') }}" required>   

          </div>
          <div class="form-group">


              <label> Tipo </label>  
              <select name="type"  value="" class="form-control" id="type">
                    
                    @hasanyrole('Administrador|Jefe de Departamento')
                    <option value="Global">Global</option>
                    @endhasanyrole
                    @hasanyrole('Docente|Jefe de Departamento')
                    <option value="Personal">Personal</option>
                    @endhasanyrole
                </select>   

          </div>

          <div class="form-group">


              <button type="submit" class="btn btn-success">Agregar</button>
              <input class="btn btn-primary" type="reset" value="Limpiar campos">
              <a class="btn btn-danger" href="{{url('event')}}">Cancelar</a>

          </div>
        </form>

      </div>
    </div>
  </div>
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