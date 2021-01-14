@extends('layouts.principal')

@section('content')
@if (\Session::has('success'))
<div class="alert alert-success">
  <p>{{ \Session::get('success') }}</p>
</div><br />
@elseif(\Session::has('fail'))
<div class="alert alert-danger">
    <p>{{ \Session::get('fail') }}</p>
  </div><br />
@endif

<div class="container">


    <h1 class="text-center" style="font-family: Arial;font-size: 25px;color: rgb(0, 0, 0);" >Migracion de datos</h1>

    <div>
      <br>
      <br>
        <a href="{{url('migracionpostgre')}}" class="btn btn-primary">Generar en formato PostgreSQL</a>
        <a href="{{url('migracionmy')}}" class="btn btn-success">Generar en formato MySQL - MariaDB</a>
        <br>    
        </div>
        <br>
        <br>
        <h1 class="text-center" style="font-family: Arial;font-size: 25px;color: rgb(0, 0, 0);" >Respaldo</h1>

        <div>
            <a href="{{url('respaldar')}}" class="btn btn-dark">Respaldar archivos aplicacion</a>
            <br>    
            </div>

</div>

<div class="container">

<table class="table table-light table-hover">
  <thead class="thead-light">
      <tr>

          <th>Nombre</th>
          <th>Tamaño</th>
          <th>Fecha de creacion</th>
          <th>Acciones</th>
          
      </tr>
  </thead>

  <tbody style="background-color: #adafb1;">
      @foreach ($respaldos as $item)
          
          <tr>
              <td>{{ $item['Nombre'] }}</td>
              <td>{{ $item['Tamaño'] }}</td>
              <td>{{ $item['Modificado'] }}</td>
              <td> 
                  
              <a class="btn btn-light" href="{{ url('/respaldo/descarga/'.$item['Nombre']) }}">Descargar</a>

      


              </td>
              
          </tr>
       @endforeach

      
  </tbody>
</table>

</div>
    
@endsection