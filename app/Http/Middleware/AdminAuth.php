<?php

namespace App\Http\Middleware;

use Closure;
use Session;
class AdminAuth
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
        if(empty(Session::get('id_admin'))){
            return redirect('login')->with('alert','Anda tidak memiliki hak akses.');
        }
        return $next($request);
    }
}
