<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the authenticated user is a super admin
        if (auth()->user()->role_id < 2) {
            // Redirect the user or show an error message
            return redirect()->route('welcome')->with('error', 'You do not have permission to access this page.');
        }
       
        return $next($request);

        // Allow the request to proceed
    }
}
