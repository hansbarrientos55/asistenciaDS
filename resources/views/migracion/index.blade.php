@extends('layouts.principal')

@section('content')


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
            <br>    
            </div>

@if (Session::has('mensaje')){{
    Session::get('mensaje')
}}
    
@endif






</div>
    
@endsection