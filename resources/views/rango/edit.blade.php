@extends('layouts.principal')

@section('content')

<div class="container">
    <div class="container" >
        <div class="row justify-content-center" >
            <div class="col-md-8">
                <div class="card" style="width: 24rem; background-color: #a3bcc9;">

    <h1 class="text-center" style="font-family: Arial;font-size: 25px;color: rgb(0, 0, 0);" >Editar rol</h1>

<form action="{{url('/rango/'.$ro->id)}}" class= "form-horizontal" style="font-family: Arial;color: rgb(0, 0, 0);" style="font-family: Arial;color: rgb(233,237,241);"  method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{method_field('PATCH')}}
    <div class="form-group">
    <label for="name" class="control-label">{{ 'Titulo' }}</label>
    <input class="form-control" type="text" name="name" id="name" value="{{$ro->name}}" required>
    @if($errors->first('name'))
    <div class="alert alert-danger" role ="alert" >
      <ul>
               <li>{{ $errors->first('name')}} </li>
      </ul>
    </div>
    @endif      
    </div>

    <div class="form-group">
        <label for="permisos" class="control-label">{{ 'Permisos' }}</label>
        <table>
            <tbody>
                @foreach ($permisos as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td><input type="checkbox" id="{{$item->id}}" name="{{$item->name}}" value="{{$item->name}}"></td>    
                        <td><label for="{{$item->name}}"> {{$item->name}}</label><br></td>
                    </tr>    
            
                @endforeach

            </tbody>


        </table>

    </div>


    <input type="submit" class="btn btn-success" value="Guardar cambios">
    <a class="btn btn-danger" href="{{url('rango')}}">Cancelar</a>


</form>

</div>
</div>
</div>
</div>


</div>
@endsection