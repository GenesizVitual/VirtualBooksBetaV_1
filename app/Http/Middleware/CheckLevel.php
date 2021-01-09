<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class CheckLevel
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
        if(empty(Session::get('level'))){
            return redirect('login')->with('alert','Anda tidak bisa mengkases halaman ini');
        }
        return $next($request);
    }
}
