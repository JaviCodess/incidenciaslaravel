<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Middleware\Auth;

class profe
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

      //comprueba que el usuario está autenticado y si el atributo admin es igual a 0
      if( auth()->check() &&  auth()->user()->admin == 0){

            return $next($request);
          }
            return redirect('/home-admin');


            
    }
}
