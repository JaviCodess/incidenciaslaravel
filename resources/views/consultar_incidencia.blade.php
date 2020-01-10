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
                        <form method="POST" action="/home/crear-incidencia/rellenar">
                            @csrf
                            Fecha de la incidencia: <input type="date" name="fecha"><br>
                            Nº del aula: <input type="string" name="aula"><br>
                            Hora de la incidencia: <input type="time" name="hora"><br>
                            Código del equipo del aula: HZ<input type="string" name="equipo"><br>
                            Código de incidencia: <input type="number" min="1" max="10" name="inc"><br>
                            <input type="string" name="idp" value="{{Auth::user()->id}}" style="display: none;">
                            <input type="submit" value="Enviar">
                        </form>
                </div>
            </div>
            <button><a href="{{url('/home')}}">Volver</a></button>
            <br>
            <div class="card">
            <div class="card-header"><h3>Códigos de averías/ Matxuren kodigoak</h3></div>
            <div class="card-body">    
                <p>1……………….No se enciende la CPU/ CPU ez da pizten</p>
                <p>2……………….No se enciende la pantalla/Pantaila ez da pizten</p>
                <p>3……………….No entra en mi sesión/ ezin sartu nere erabiltzailearekin</p>
                <p>4……………….No navega en Internet/ Internet ez dabil</p>
                <p>5……………….No se oye el sonido/ Ez da aditzen</p>
                <p>6……………….No lee el DVD/CD</p>
                <p>7……………….Teclado roto/ Tekladu hondatuta</p>
                <p>8……………….No funciona el ratón/Xagua ez dabil</p>
                <p> 9……………….Muy lento para entrar en la sesión/oso motel dijoa</p>
                <p>10…………………………………………………………………………………..(Otros) Especifica</p>
            </div>
            </div>
            
        </div>
    </div>
</div>
@endsection