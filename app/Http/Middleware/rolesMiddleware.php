<?php

namespace App\Http\Middleware;

use Closure;

class rolesMiddleware
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
        // if(!auth()->check()|| !auth()->role_id==1){
        //     abort(403);
        // }
        // else if(!auth()->check()|| !auth()->role_id==2){
        //     abort(403);
        // }
        //  else if(!auth()->check()|| !auth()->role_id==3){
        //     abort(403);
        // }
        // else  if(!auth()->check()|| !auth()->role_id==4){
        //     abort(403);
        // }
       
        return $next($request);
    }
}
