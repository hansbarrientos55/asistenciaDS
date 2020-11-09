@extends('layouts.principal')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body" style="font-family: Arial;font-size: 18px;color: rgb(0, 0, 0);">

                    <div class="col" style=""><img src="{{ asset('fondo.png') }}"></div>
        
                </div>
                

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
