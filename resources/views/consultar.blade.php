@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Panel de control</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @foreach ($incidencia as $item)
                        <h2>Comentario del administrador:</h2>
                        <p>{{$item->informacion}}</p><br>
                        
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection