<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::where('is_active', true)->orderBy('sort_order')->get();
        $contactSettings = Settings::where('group', 'contact')->pluck('value', 'key')->toArray();
        $heroSettings = Settings::where('group', 'hero')->pluck('value', 'key')->toArray();

        return view('services.index', [
            'services' => $services,
            'contact' => [
                'phone' => $contactSettings['contact_phone'] ?? '+1.3476366128',
                'address' => $contactSettings['contact_address'] ?? '358 Amboy St, Brooklyn',
                'whatsapp' => str_replace(['.', ' ', '-'], '', $contactSettings['contact_phone'] ?? '13476366128'),
            ],
            'hero' => [
                'cta_text' => $heroSettings['hero_cta_text'] ?? 'Get Your Free Quote',
            ],
        ]);
    }

    public function show(string $slug)
    {
        $service = Service::where('slug', $slug)
            ->where('is_active', true)
            ->with('projects')
            ->firstOrFail();

        $contactSettings = Settings::where('group', 'contact')
            ->pluck('value', 'key')
            ->toArray();

        $heroSettings = Settings::where('group', 'hero')
            ->pluck('value', 'key')
            ->toArray();

        // Projects for this service
        $projects = $service->projects()->take(6)->get();

        // Fallback: get by category or featured if no related projects
        if ($projects->isEmpty()) {
            $category = $this->slugToCategory($slug);
            $projects = \App\Models\Project::where('category', $category)
                ->orWhere('is_featured', true)
                ->orWhereNotNull('image_after')
                ->latest()
                ->take(6)
                ->get();
        }

        // Related services (2, excluding current) for internal linking
        $relatedServices = Service::where('is_active', true)
            ->where('id', '!=', $service->id)
            ->orderBy('sort_order')
            ->take(2)
            ->get();

        // 2 projects for contextual internal linking
        $relatedProjects = $projects->take(2);

        // CTA estratégico: servicio específico > borough (si detectado) > default
        $ctaText = $service->cta_text
            ?? config('cta.by_service.' . $service->slug)
            ?? $heroSettings['hero_cta_text']
            ?? config('cta.default', 'Get Your Free Construction Estimate in 24 Hours');

        return view('services.show', [
            'service' => $service,
            'projects' => $projects,
            'relatedServices' => $relatedServices,
            'relatedProjects' => $relatedProjects,
            'contact' => [
                'phone' => $contactSettings['contact_phone'] ?? '+1.3476366128',
                'phone_link' => str_replace(['.', ' ', '-'], '', $contactSettings['contact_phone'] ?? $contactSettings['contact_phone_link'] ?? '13476366128'),
            ],
            'hero' => [
                'cta_text' => $ctaText,
            ],
        ]);
    }

    private function slugToCategory(string $slug): string
    {
        return match (true) {
            str_contains($slug, 'commerce') || str_contains($slug, 'commercial') => 'commercial',
            str_contains($slug, 'renov') || str_contains($slug, 'remodel') => 'renovation',
            default => 'residential',
        };
    }
}
