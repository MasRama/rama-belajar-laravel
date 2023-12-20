<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Get the user from the request
        $user = auth()->user();

        // Check if the user is an admin
        if ($user->roles === 'admin') {
            // If the user is an admin, proceed with the request
            return $next($request);
        }

        // If the user is not an admin, redirect them to the home page
        return redirect('/');
    }
}
