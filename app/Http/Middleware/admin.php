<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Middleware\Auth;

class admin
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

      //comprueba que el usuario está autenticado y si el atributo admin es igual a 1
      if( auth()->check() &&  auth()->user()->admin == 1){

            return $next($request);
          }
            return redirect('/home');


            
    }
}
