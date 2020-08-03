<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class CheckUserID
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
        if(empty(Session::get('user_id'))){
//            return redirect('login')->with('message_error','Waktu Akses telah berakhir');
        }

        return $next($request);
    }
}
