<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CaptureUtmParams
{
    /**
     * Store UTM and lead_source in session when present in URL.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->has('utm_source')) {
            $request->session()->put('utm_source', $request->query('utm_source'));
        }
        if ($request->has('utm_medium')) {
            $request->session()->put('utm_medium', $request->query('utm_medium'));
        }
        if ($request->has('utm_campaign')) {
            $request->session()->put('utm_campaign', $request->query('utm_campaign'));
        }
        if ($request->has('utm_content')) {
            $request->session()->put('utm_content', $request->query('utm_content'));
        }
        if ($request->has('lead_source')) {
            $request->session()->put('lead_source', $request->query('lead_source'));
        }
        if ($request->has('gclid')) {
            $request->session()->put('gclid', $request->query('gclid'));
        }
        if ($request->has('fbclid')) {
            $request->session()->put('fbclid', $request->query('fbclid'));
        }

        return $next($request);
    }
}
