<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);
        $response->headers->set('Content-Security-Policy', "frame-ancestors 'none'; object-src 'none'; base-uri 'self'; upgrade-insecure-requests");
        if ($policy = config('app.csp_enforce')) {
            $response->headers->set('Content-Security-Policy', $policy, false);
        }

        if ($policy = config('app.csp_report_only')) {
            $response->headers->set('Content-Security-Policy-Report-Only', $policy);
        }
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
        $response->headers->remove('X-Powered-By');

        if ($request->isSecure()) {
            $response->headers->set('Strict-Transport-Security', 'max-age=86400');
        }

        return $response;
    }
}
