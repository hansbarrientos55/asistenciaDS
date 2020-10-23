@extends('layouts.principal')

@section('content')

<div class="container">

<title>Administrador</title>

@if (Session::has('mensaje')){{
    Session::get('mensaje')
}}
    
@endif


<br>
<br>



</div>
@endsection

