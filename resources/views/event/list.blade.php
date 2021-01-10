@extends('layouts.principal')

@section('content')

<div class="container">

    <div class="container">
        <br/>
        <h2 class="text-center" style="font-family: Arial;font-size: 25px;color: rgb(0, 0, 0);" >Listado de eventos</h2>

        <a href="{{url('event/add')}}" class="btn btn-success">Agregar evento</a>
        <table class="table table-light table-hover">
          <thead class="thead-light">
              <tr>
      
                  <th>Id</th>
                  <th>Titulo</th>
                  <th>Fecha de inicio</th>
                  <th>Fecha de finalizacion</th>
                  <th>Tipo</th>
                  <th>Acciones</th>
                  
              </tr>
          </thead>
      
          <tbody style="background-color: #adafb1;">
              @foreach ($eventos as $item)
                  
              
                  <tr>
                      <td>{{$item->id}}</td>
                      <td>{{$item->title}}</td>
                      <td>{{$item->start}}</td>
                      <td>{{$item->end}}</td>
                      <td>{{$item->type}}</td>
                      <td> 
                    
                    @if($item->creator == Auth::id())

                    <a class="btn btn-warning" href="{{ url('/event/edit/'.$item->id.'') }}">Editar</a>
                    <form action="{{ url('/event/delete/'.$item->id) }}" style="display:inline" method="post">
                        {{ csrf_field() }}   
                       <button class="btn btn-danger" type="submit" onclick="return confirm('Eliminar ?');" >Eliminar</button>
                   </form>  


                    @endif

                        
                      
      
                      </td>
                      
                  </tr>
               @endforeach
      
              
          </tbody>
      </table>

      <a class="btn btn-dark" href="{{url('event')}}">Volver a calendario</a>
</div>
@endsection