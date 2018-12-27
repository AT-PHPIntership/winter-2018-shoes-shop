<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Role;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if(Auth::user() && Auth::user()->role->name == $role){
            return $next($request);
        }else{
            return redirect('/');
        }
    }
}
