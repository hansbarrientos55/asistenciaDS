@extends('layouts.principal')

@section('content')

<div class="container">
    <div class="container" >
        <div class="row justify-content-center" >
            <div class="col-md-8">
                <div class="card" style="width: 50rem; height: 15rem; background-color: #a3bcc9;">

                    <h2 class="text-center" style="font-family: Arial;font-size: 25px;color: rgb(0, 0, 0);" >Importar usuarios de archivo externo</h2>

    

                        <form action="{{route('guardar')}}" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="input-group mb-3 mt-3">
                                    <div class="custom-file">
                                        <input type="file" name="users" class="custom-file-input" id="users">
                                        <label class="custom-file-label" for="users">Elegir archivo</label>
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
                            </div>
                                
                           
                        </form>



                 </div>
            </div>
        </div>
    </div>

</div>
@endsection