<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
         if (!Auth::guard('seller')->check()) {
            return to_route('seller.login');
        }

        $user = Auth::guard('seller')->user();
        if ($user->role !== 'admin') {
            return to_route('seller.index'); 
        }

        return $next($request);
    }
}
