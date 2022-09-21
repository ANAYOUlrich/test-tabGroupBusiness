<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class checkRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, string $role )
    {
        $roles = explode(',',$role);
        $retour = false;

        foreach ($roles as $role) {
            $request->user()->role->libelle == $role ? $retour = true : '';
        }

        $retour ? '' : abort(403);

        return $next($request);
    }
}
