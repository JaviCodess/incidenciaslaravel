@extends('layouts.app')

@section('content')
<style>
    a.inc{ 
        text-decoration-color: none;
        text-decoration: none;
        color: white;
        background-color: #3399FF;
        padding: 1%;
        float: right;
    }
    a.inc:hover{
        text-decoration: none; 
        background-color: #6CB5FF;
    }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Panel de control<a class="inc" href="/home/crear-incidencia">Crear incidencia</a></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <center>
                        <table border="1px solid black">
                            <tr>
                                <th>Fecha</th>
                                <th>Aula</th>
                                <th>Hora</th>
                                <th>Código del equipo</th>
                                <th>Código de la incidencia</th>
                                <th>Estado</th>
                            </tr>
                        @foreach ($incidencias as $incidencia)
                            <tr>
                                <td>{{$incidencia->fecha}}</td>
                                <td>{{$incidencia->aula}}</td>
                                <td>{{$incidencia->hora}}</td>
                                <td align="center">{{$incidencia->codigo_equipo}}</td>
                                <td align="center">{{$incidencia->codigo_incidencia}}</td>
                                <td>{{$incidencia->estado}}</td>
                                <td><a href="/home/modificar-incidencia/{{$incidencia->id}}"><center><img width="30%" src="{!! asset('pencil-edit-button.png')!!}"></center></a></td>
                                <td><a href="/home/eliminar-incidencia/{{$incidencia->id}}"><center><img width="30%" src="{!! asset('rubbish-bin.png')!!}"></center></a></td>
                                <td><a href="/home/consultar-incidencia/{{$incidencia->id}}"><center><img width="30%" src="{!! asset('binoculars.png')!!}"></center></a></td>
                            </tr>
                        @endforeach
                    </center>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection