<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ... $roles)
    {
        $user = Auth::guard('api')->user()->rights_group ?? 0; 

        // Check if user has the role This check will depend on how your roles are set up
        if (in_array($user, $roles)) {
            return $next($request);
        }

        return redirect('home');
    }
}
