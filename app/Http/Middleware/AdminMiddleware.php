<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Models\Role;

class AdminMiddleware
{
    /**
     * Handle an incoming request
     *
     * @param \Illuminate\Http\Request $request request
     * @param \Closure                 $next    next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role->id === Role::ADMIN_ROLE) {
            return $next($request);
        } else {
            return redirect('admin/login');
        }
    }
}
