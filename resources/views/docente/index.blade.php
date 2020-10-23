@extends('layouts.app')

@section('content')

<div class="container">

<title>Lista de Docentes</title>

@if (Session::has('mensaje')){{
    Session::get('mensaje')
}}
    
@endif



<table class="table table-light table-hover">
    <thead class="thead-light">
        <tr>

            <th> Id </th>
            <th>Nombre</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($docentes as $item)
            
        
            <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->nombre}} </td>
                <td> 
                    
                


                </td>
                
            </tr>
         @endforeach

        
    </tbody>
</table>

</div>
@endsection

