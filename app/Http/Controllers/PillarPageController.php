<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Service;
use App\Models\Settings;

class PillarPageController extends Controller
{
    public function show()
    {
        $contactSettings = Settings::where('group', 'contact')->pluck('value', 'key')->toArray();
        $heroSettings = Settings::where('group', 'hero')->pluck('value', 'key')->toArray();
        $pillarContent = Settings::where('group', 'pillar_nyc')->pluck('value', 'key')->toArray();

        $services = Service::where('is_active', true)->orderBy('sort_order')->get();
        $projects = Project::whereNotNull('slug')->latest()->take(6)->get();

        return view('pages.pillar-nyc', [
            'contact' => [
                'phone' => $contactSettings['contact_phone'] ?? '+1.3476366128',
                'phone_link' => str_replace(['.', ' ', '-'], '', $contactSettings['contact_phone'] ?? '13476366128'),
                'address' => $contactSettings['contact_address'] ?? '358 Amboy St, Brooklyn',
            ],
            'hero' => ['cta_text' => $heroSettings['hero_cta_text'] ?? 'Get Your Free Quote'],
            'pillar' => $pillarContent,
            'services' => $services,
            'projects' => $projects,
        ]);
    }
}
