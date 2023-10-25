<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DatabaseAdmin
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
            if (Auth::user()->db_admin == '1') {
                return $next($request);
            } else {
                return redirect('/')->with(['status'=>'El usuario '.Auth::user()->name.' no tiene acceso a este módulo!','icon'=>'error']);
            }
        } else {
            return redirect('/')->with('status', 'Primero debes loguearte');
        }
    }
}
