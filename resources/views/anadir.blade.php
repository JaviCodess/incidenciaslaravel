@extends('layouts.app')

@section('content')
<style>
    input{
        margin: 2% 0 0 0;
    }
</style>
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
                        <form method="POST" enctype="multipart/form-data" action="/home-admin/anadir/{{$item->id}}/modificado">
                            @csrf
                            Estado de la incidencia: <select name="estado">
                                <option value="En proceso">En proceso</option>
                                <option value="Recibida">Recibida</option>
                                <option value="Resuelta">Resuelta</option>
                                <option value="Rechazada">Rechazada</option>
                            </select><br>
                            Comentario:
                            <br>
                            <textarea name="comentario" rows="10" cols="50"></textarea><br>
                            
                            <input type="submit" value="Enviar">
                        </form>
                        @endforeach
                        @if(count($errors))
                            <div class="errors">
                                <div class="alert alert-danger" role="alert">
                                    @foreach($errors->all() as $message)
                                    <ul>
                                        <li>{{ $message }} </li>
                                    </ul>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection