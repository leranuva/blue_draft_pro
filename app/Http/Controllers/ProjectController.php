<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Service;
use App\Models\Settings;

class ProjectController extends Controller
{
    public function show(string $slug)
    {
        $project = Project::where('slug', $slug)->firstOrFail();

        $contactSettings = Settings::where('group', 'contact')
            ->pluck('value', 'key')
            ->toArray();

        $heroSettings = Settings::where('group', 'hero')
            ->pluck('value', 'key')
            ->toArray();

        // Related projects (same category)
        $related = Project::where('category', $project->category)
            ->where('id', '!=', $project->id)
            ->whereNotNull('image_after')
            ->latest()
            ->take(3)
            ->get();

        // Related services (2) for internal linking
        $relatedServices = Service::where('is_active', true)
            ->orderBy('sort_order')
            ->take(2)
            ->get();

        return view('projects.show', [
            'project' => $project,
            'related' => $related,
            'relatedServices' => $relatedServices,
            'contact' => [
                'phone' => $contactSettings['contact_phone'] ?? '+1.3476366128',
                'phone_link' => $contactSettings['contact_phone_link'] ?? str_replace(['.', ' ', '-'], '', $contactSettings['contact_phone'] ?? '13476366128'),
            ],
            'hero' => [
                'cta_text' => $heroSettings['hero_cta_text'] ?? 'Get Your Free Quote',
            ],
        ]);
    }
}
