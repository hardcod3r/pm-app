<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  int  $requiredRole
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, int $requiredRole): Response
    {
        $user = $request->user();

        // Ensure the user is authenticated
        if (!$user) {
            abort(403, 'Forbidden: You do not have the required role.');
        }

        // Check if the user role matches the required role
        if ((int)$user->role !== $requiredRole) {
            abort(403, 'Forbidden: You do not have the required role.');
        }

        return $next($request);
    }
}
