<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CacheHeaders
{
    /**
     * Cache durations in seconds.
     */
    protected array $durations = [
        'static' => 86400,      // 24 hours - images, CSS, JS
        'page' => 3600,        // 1 hour - HTML pages
        'sitemap' => 3600,     // 1 hour - sitemap.xml
    ];

    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Only cache successful GET responses
        if (! $request->isMethod('GET') || $response->getStatusCode() !== 200) {
            return $response;
        }

        // Sitemap
        if ($request->routeIs('sitemap')) {
            return $response->withHeaders([
                'Cache-Control' => 'public, max-age=' . $this->durations['sitemap'] . ', s-maxage=' . $this->durations['sitemap'],
            ]);
        }

        // Skip cache for admin, auth, etc.
        if ($request->is('system-bd-access*') || $request->is('admin*')) {
            return $response->withHeaders([
                'Cache-Control' => 'no-store, no-cache, must-revalidate',
            ]);
        }

        // Public pages: HTML pages
        if ($request->acceptsHtml()) {
            return $response->withHeaders([
                'Cache-Control' => 'public, max-age=' . $this->durations['page'] . ', s-maxage=' . $this->durations['page'] . ', stale-while-revalidate=300',
            ]);
        }

        return $response;
    }
}
