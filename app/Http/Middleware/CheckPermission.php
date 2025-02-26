<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $permission)
    {

        if (Auth::check()) {
            $user = Auth::user();
            
            if ($user->role && $user->role->permissions()->where('permissions', 'LIKE', "%{$permission}%")->exists()) {
                return $next($request);
            }
        }

        abort(403, 'Action not permitted');
    }
}
