<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Models\Role;

class AdminMiddleware
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
        if (Auth::check() && Auth::user()->role->name !== Role::CUSTOMER_ROLE) {
            return $next($request);
        }else{
            return redirect('admin/login');
        }
    }
}
