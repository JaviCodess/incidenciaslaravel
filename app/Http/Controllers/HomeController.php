<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Incidencia;
use App\User;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $incidencias = Incidencia::select('id','fecha', 'aula', 'hora', 'codigo_equipo', 'codigo_incidencia', 'profesorId', 'estado')->where('profesorId', Auth::user()->id)->get();
        return view('home', ['incidencias'=>$incidencias]);
    }
    public function indexAdmin()
    {
        $incidencias = Incidencia::select('id','fecha', 'aula', 'hora', 'codigo_equipo', 'codigo_incidencia', 'profesorId', 'estado')->get();

        return view('home_admin', ['incidencias'=>$incidencias]);
    }
}
