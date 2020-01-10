<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Incidencia;
use App\User;
use Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use App\Mail\ModMail;

class ControladorIncidencia extends Controller
{
    //
    public function cIncidencia(){
        return view('crear_incidencia');
    }
    protected function validator(Request $request)
    {
        $validator=Validator::make($request->all(), [
            'fecha' => ['required'],
            'aula' => ['required', 'regex:/(\d\d\d)/'],
            'hora' => ['required'],
            'equipo' => ['required','regex:/(\d\d\d\d\d\d)/'],
            'inc' => ['required']
        ],[
            'required' => 'El :attribute es obligatorio.',
            'regex' => 'El formato de :attribute no es correcto',
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }else{

            $incidencia = new Incidencia;
            $incidencia->fecha = $request->fecha;
            $incidencia->aula = $request->aula;
            $incidencia->hora = $request->hora;
            $incidencia->codigo_equipo = $request->equipo;
            $incidencia->codigo_incidencia = $request->inc;
            $incidencia->profesorId = $request->idp;
            $incidencia->save();
                
            Mail::to(User::findOrFail(1))->send(new SendMail($incidencia, $incidencia->id));
     
            
            return redirect('/home');
        }
        
    
    }
    
    protected function modvistaIncidencia(Request $request, $i){
        $incidencia = Incidencia::select('id', 'fecha', 'aula', 'hora', 'codigo_equipo', 'codigo_incidencia')->where('id', $i)->get();
        return view('mod_incidencia')->with('incidencia',$incidencia);
    }
    protected function modIncidencia(Request $request, $i){
        $validator=Validator::make($request->all(), [
            'fecha' => ['required'],
            'aula' => ['required', 'regex:/(\d\d\d)/'],
            'hora' => ['required'],
            'equipo' => ['required','regex:/(\d\d\d\d\d\d)/'],
            'inc' => ['required']
        ],[
            'required' => 'El :attribute es obligatorio.',
            'regex' => 'El formato de :attribute no es correcto',
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }else{

            $incidencia = Incidencia::findOrFail($i);
            $incidencia->fecha = $request->fecha;
            $incidencia->aula = $request->aula;
            $incidencia->hora = $request->hora;
            $incidencia->codigo_equipo = $request->equipo;
            $incidencia->codigo_incidencia = $request->inc;
            $incidencia->update();
                
            $incidencias =Incidencia::select('id','fecha', 'aula', 'hora', 'codigo_equipo', 'codigo_incidencia')->where('profesorId', Auth::User()->id)->get();
            return redirect('/home');
        
        }
    }
    protected function eliminarIncidencia(Request $request, $i){
        $incidencia = Incidencia::findOrFail($i);
        $incidencia->delete();
        return back();
    }
    protected function consultar(Request $request, $i){
        $incidencia = Incidencia::select('id', 'fecha', 'aula', 'hora', 'codigo_equipo', 'codigo_incidencia', 'informacion', 'archivo')->where('id', $i)->get();
        return view('consultar')->with('incidencia',$incidencia);
    }

    //ADMIN
    protected function anadir(Request $request, $i){
        $incidencia = Incidencia::select('id', 'fecha', 'aula', 'hora', 'codigo_equipo', 'codigo_incidencia')->where('id', $i)->get();
        return view('anadir')->with('incidencia',$incidencia);
    }   
    protected function actualizarAnadir(Request $request, $i){
        $validator=Validator::make($request->all(), [
            'estado' => ['required'],
            'comentario' => ['required']
        ]);
        if($validator->fails()){
            return back();
        }else{

            $incidencia = Incidencia::findOrFail($i);
            $incidencia->estado = $request->estado;
            $incidencia->informacion = $request->comentario;
            $incidencia->archivo = $request->adjun;
            
            $incidencia->update();
                
            $incidencias = Incidencia::select('id','fecha', 'aula', 'hora', 'codigo_equipo', 'codigo_incidencia', 'profesorId', 'estado')->get();
            
            Mail::to(User::findOrFail($incidencia->profesorId))->send(new ModMail($incidencia, $incidencia->id));

            return redirect('/home-admin');

        
        }
    }
}