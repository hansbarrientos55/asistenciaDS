@extends('layouts.principal')

@section('content')

<div class="container">
    <div class="container" >
        <div class="row justify-content-center" >
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card" style="background-color: #a3bcc9;">

                            <h2 class="text-center" style="font-family: Arial;font-size: 25px;color: rgb(0, 0, 0);" >Importar usuarios de archivo externo</h2>
        
            
        
                                <form action="{{route('guardar')}}" method="post" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <div class="input-group mb-3 mt-3">
                                            <div class="form-group">
                                                <label for="users" class="control-label">Archivo</label>
                                                <input class="form-control" type="file" name="users" id="users" value="">
                                            </div>
                                            
                                            <div>
                                                @if ( $errors->any() )
                                                <div class="alert alert-danger">
                                                    @foreach( $errors->all() as $error )<li>{{ $error }}</li>@endforeach
                                                </div>
                                            @endif
                                
                                            @if(isset($numRows))
                                                <div class="alert alert-sucess">
                                                    Se importaron {{$numRows}} registros.
                                                </div>
                                            @endif
        
                                            </div>
                                           
                                    </div>
                                    <div class="row ml-0">        
                                                <button type="submit" class="btn btn-primary">Registrar usuarios</button>
                                                <a class="btn btn-danger" href="{{url('user')}}">Cancelar</a>
                                                <a class="btn btn-info" href="{{url('user')}}">Volver a la lista de usuarios</a>
                                    </div>
                                        
                                   
                                </form>
        
        
        
                         </div>
                    </div>
                    <div class="col-md-4">
                        
                        <p class="text-center" style="font-size:16px;margin-top:20px;font-weight:bold;">Para agregar usuarios, debe considerar lo siguiente:</p>
                        <p class="text-center" style="font-size:16px;margin-top:20px;font-weight:bold;">1. Archivo con extension: .CSV.</p>
                        <p class="text-center" style="font-size:16px;margin-top:20px;font-weight:bold;">2. Encabezado: (Ver archivo de ejemplo)</p>
                        <p class="text-center" style="font-size:16px;margin-top:20px;font-weight:bold;">3. Los campos deben estar separados por comas (,) y al final de cada registro, el delimitador es un salto de linea (pulsar tecla Enter)</p>
                        <p class="text-center" style="font-size:16px;margin-top:20px;font-weight:bold;">4. Ningun campo debe estar vacio.</p>
                        <a href="{{url('descargarejemplo')}}" class="text-center" style="font-size:16px;margin-top:20px;font-weight:bold;color:#ab0707;">Descargar ejemplo</a>
                        
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection