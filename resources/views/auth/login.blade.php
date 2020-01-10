@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                                <a href="{{url('/redirect')}}" style="margin-top: 20px;" class="btn btn-lg btn-success btn-block"><strong>Inicia sesión con google</strong></a>
                                <iframe id="idlogoutframe" src="https:\\accounts.google.com/logout" style="display:none"></iframe>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
