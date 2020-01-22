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
            'fecha' => 'required|date_format:Y-m-d',
            'aula' => ['required', 'regex:/(\d\d\d)/'],
            'hora' => ['required', 'date_format:H:i'],
            'equipo' => ['required','regex:/(\d\d\d\d\d\d)/'],
            'inc' => ['required', 'numeric', 'regex:/(\d)/']
        ],[
            'required' => 'El campo de :attribute es obligatorio.',
            'regex' => 'El formato del campo :attribute no es correcto',
            'inc.required' => 'El campo de la incidencia es obligatorio.',
            'inc.regex' => 'El formato del campo la incidencia no es correcto',
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
                
            $data = array('incidencia' => $incidencia);
            Mail::send('email', $data, function ($message){
                $message->from('sanchezfjaviersanchez@plaiaundi.net', 'Incidencia creada');
                $datos=User::select('email')->where('admin', 1)->get();
                foreach($datos as $email){
                    $message->to($email->email)->subject('Incidencia Añadida');
                }
            });
            
            return redirect('/home');
        }
        
    
    }
    
    protected function modvistaIncidencia(Request $request, $i){
        $datos = Incidencia::find($i);
        $this->authorize('view',$datos);
        $incidencia = Incidencia::select('id', 'fecha', 'aula', 'hora', 'codigo_equipo', 'codigo_incidencia')->where('id', $i)->get();
        return view('mod_incidencia')->with('incidencia',$incidencia);
    }
    protected function modIncidencia(Request $request, $i){
        $validator=Validator::make($request->all(), [
            'fecha' => ['required','date_format:Y-m-d'],
            'aula' => ['required', 'regex:/(\d\d\d)/'],
            'hora' => ['required', 'date_format:H:i'],
            'equipo' => ['required','regex:/(\d\d\d\d\d\d)/'],
            'inc' => ['required', 'numeric', 'regex:/(\d)/']
        ],[
            'required' => 'El campo de :attribute es obligatorio.',
            'regex' => 'El formato del campo :attribute no es correcto',
            'fecha.date_format' => 'El formato de fecha es dd/mm/aa',
            'hora.date_format' => 'El formato de hora es hh:mm',
            'inc.required' => 'El campo de la incidencia es obligatorio.',
            'inc.regex' => 'El formato del campo la incidencia no es correcto',
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
        $datos = Incidencia::find($i);
        $this->authorize('view',$datos);
        $incidencia = Incidencia::findOrFail($i);
        $incidencia->delete();
        return back();
    }
    protected function consultar(Request $request, $i){
        $datos = Incidencia::find($i);
        $this->authorize('view',$datos);
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
            'estado' => ['required', 'integer','between:1,4'],
            'comentario' => ['required'],
        ],[
            'required' => 'El campo de :attribute es obligatorio.',
            
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }else{

            $incidencia = Incidencia::findOrFail($i);
            if($request->input('estado') == '1'){
                $incidencia->estado = "En proceso";
            }else if($request->input('estado') == '2'){
                $incidencia->estado = "Recibida";
            }else if($request->input('estado') == '3'){
                $incidencia->estado = "Resuelta";
            }else if($request->input('estado') == '4'){
                $incidencia->estado = "Rechazada";
            }
            $incidencia->informacion = $request->comentario;
            
            $incidencia->update();
                
            $incidencias = Incidencia::select('id','fecha', 'aula', 'hora', 'codigo_equipo', 'codigo_incidencia', 'profesorId', 'estado')->get();
            
            Mail::to(User::findOrFail($incidencia->profesorId))->send(new ModMail($incidencia, $incidencia->id));

            return redirect('/home-admin');

        
        }
    }
}