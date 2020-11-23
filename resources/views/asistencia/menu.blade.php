@extends('layouts.principal')

@section('content')
    

<div class="container">

    <h1 class="text-center" style="font-family: Arial;font-size: 25px;color: rgb(0, 0, 0);" >Administracion de Asistencias y Avances</h1>

    <div>
        <a href="{{url('asistencialista')}}" class="btn btn-primary">Semanales</a>
        <a href="{{url('mensual')}}" class="btn btn-success">Mensuales</a>
        <br>    
        </div>


    <div>
        
    <br>
    </div>
    


</div>
@endsection
