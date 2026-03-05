<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Project;
use App\Models\Service;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $urls = [];

        // Home
        $urls[] = [
            'loc' => route('home'),
            'changefreq' => 'weekly',
            'priority' => '1.0',
        ];

        // Pillar page NYC
        $urls[] = [
            'loc' => route('pillar.nyc'),
            'changefreq' => 'weekly',
            'priority' => '0.95',
        ];

        // Pillar pages other cities
        foreach (array_keys(config('pillar_cities.cities', [])) as $city) {
            $urls[] = [
                'loc' => route('pillar.city', $city),
                'changefreq' => 'weekly',
                'priority' => '0.9',
            ];
        }

        // Phase 5: Lead magnet & cost calculator
        $urls[] = [
            'loc' => route('lead-magnet.show'),
            'changefreq' => 'monthly',
            'priority' => '0.85',
        ];
        $urls[] = [
            'loc' => route('cost-calculator'),
            'changefreq' => 'monthly',
            'priority' => '0.85',
        ];

        // Services (index redirects to home#services)
        // Services
        Service::where('is_active', true)->get()->each(function (Service $service) use (&$urls) {
            $urls[] = [
                'loc' => route('services.show', $service->slug),
                'changefreq' => 'monthly',
                'priority' => '0.8',
            ];
        });

        // Projects
        Project::whereNotNull('slug')->get()->each(function (Project $project) use (&$urls) {
            $urls[] = [
                'loc' => route('projects.show', $project->slug),
                'changefreq' => 'monthly',
                'priority' => '0.7',
            ];
        });

        // Blog posts (published)
        Post::published()->get()->each(function (Post $post) use (&$urls) {
            $urls[] = [
                'loc' => route('blog.show', $post->slug),
                'changefreq' => 'weekly',
                'priority' => '0.7',
            ];
        });

        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
        foreach ($urls as $u) {
            $xml .= '  <url>' . "\n";
            $xml .= '    <loc>' . htmlspecialchars($u['loc']) . '</loc>' . "\n";
            if (! empty($u['lastmod'])) {
                $xml .= '    <lastmod>' . $u['lastmod'] . '</lastmod>' . "\n";
            }
            $xml .= '    <changefreq>' . ($u['changefreq'] ?? 'weekly') . '</changefreq>' . "\n";
            $xml .= '    <priority>' . ($u['priority'] ?? '0.5') . '</priority>' . "\n";
            $xml .= '  </url>' . "\n";
        }
        $xml .= '</urlset>';

        return response($xml, 200, [
            'Content-Type' => 'application/xml',
            'Charset' => 'UTF-8',
        ]);
    }
}
