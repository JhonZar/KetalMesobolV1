<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class VerifySessionFields
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next,...$fields)
    {
        foreach ($fields as $field) {
            if (!Session::has($field)) {
                return redirect('/')->with('error', 'La sesión no contiene todos los campos requeridos.');
            }
        }   
        return $next($request);
    }
}
