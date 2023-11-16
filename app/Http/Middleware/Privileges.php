<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Privileges
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            if (Auth::user()->privileges == '1') {
                return $next($request);
            } else {
                return redirect()->back()->with(['status'=>'El usuario '.Auth::user()->name.' no tiene privilegios para realizar esta acción, consulta al desarrollador','icon'=>'warning']);
            }
        } else {
            return redirect('/')->with('status', 'Primero debes loguearte');
        }
    }
}
