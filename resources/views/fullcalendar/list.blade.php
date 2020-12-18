@extends('layouts.principal')

@section('content')

<div class="container">

    <div class="container">
        <br/>
        <h2 class="text-center" style="font-family: Arial;font-size: 25px;color: rgb(0, 0, 0);" >Listado de eventos</h2>


        <table class="table table-light table-hover">
          <thead class="thead-light">
              <tr>
      
                  <th>Id</th>
                  <th>Titulo</th>
                  <th>Fecha de inicio</th>
                  <th>Fecha de finalizacion</th>
                  <th>Acciones</th>
                  
              </tr>
          </thead>
      
          <tbody style="background-color: #adafb1;">
              @foreach ($eventos as $item)
                  
              
                  <tr>
                      <td>{{$item->id}}</td>
                      <td>{{$item->title}}</td>
                      <td>{{$item->start_date}}</td>
                      <td>{{$item->end_date}}</td>
                      <td> 
                          
                      
      
                      </td>
                      
                  </tr>
               @endforeach
      
              
          </tbody>
      </table>

      <a class="btn btn-dark" href="{{url('event')}}">Volver a calendario</a>
</div>
@endsection