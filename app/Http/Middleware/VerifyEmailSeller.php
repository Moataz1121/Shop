<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyEmailSeller
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    { if (!$request->user('seller') || !$request->user('seller')->hasVerifiedEmail()) {
        return $request->expectsJson()
            ? abort(403, 'Your email address is not verified.')
            : redirect()->route('seller.verification.notice');
    }

    // return $next($request);
        return $next($request);
    }
}
