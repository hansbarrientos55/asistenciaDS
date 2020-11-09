@extends('layouts.principal')

@section('content')


<div class="container">


    <h1 class="text-center" style="font-family: Arial;font-size: 25px;color: rgb(0, 0, 0);" >Configuracion del sistema</h1>


@if (Session::has('mensaje')){{
    Session::get('mensaje')
}}
    
@endif


<a href="{{url('/permisos')}}" class="btn btn-success">Actualizar permisos</a>
<br>
<a href="{{url('/horasydias')}}" class="btn btn-primary">Generar horas y dias</a>
<br>



</div>
    
@endsection