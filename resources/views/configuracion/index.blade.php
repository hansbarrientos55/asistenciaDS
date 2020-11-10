@extends('layouts.principal')

@section('content')


<div class="container">


    <h1 class="text-center" style="font-family: Arial;font-size: 25px;color: rgb(0, 0, 0);" >Configuracion del sistema</h1>


@if (Session::has('mensaje')){{
    Session::get('mensaje')
}}
    
@endif






</div>
    
@endsection