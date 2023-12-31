<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Debug output to see roles being checked
        //dump($roles);

        if (in_array($request->user()->type, $roles)) {
            return $next($request);
        }
    
        abort(403, 'Unauthorized action.');
    }
}
