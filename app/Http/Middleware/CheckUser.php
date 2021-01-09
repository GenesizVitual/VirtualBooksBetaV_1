<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class CheckUser
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
        if(empty(Session::get('kode'))){
            return redirect('login')->with('alert','Anda tidak memiliki hak akses.');
        }
        return $next($request);
    }
}
