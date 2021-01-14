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
        <a href="{{url('migracionpostgre')}}" class="btn btn-primary">Generar en formato PostgreSQL</a>
        <a href="{{url('migracionmy')}}" class="btn btn-success">Generar en formato MySQL - MariaDB</a>
        <br>    
        </div>
        <br>
        <h1 class="text-center" style="font-family: Arial;font-size: 25px;color: rgb(0, 0, 0);" >Respaldo</h1>

        <div>
            <a href="{{url('respaldar')}}" class="btn btn-light">Respaldar archivos aplicacion</a>
            <a href="{{url('respaldos')}}" class="btn btn-dark">Lista de respaldos</a>
            <br>    
            </div>








</div>
    
@endsection