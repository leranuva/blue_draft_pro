<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Service;
use App\Models\Settings;
use Illuminate\Http\Response;
use Illuminate\View\View;

class PillarCityController extends Controller
{
    public function show(string $city): View|Response
    {
        $cities = config('pillar_cities.cities', []);
        if (! isset($cities[$city])) {
            abort(404);
        }

        $cityConfig = $cities[$city];
        $settingsGroup = 'pillar_' . $city;
        $pillarContent = Settings::where('group', $settingsGroup)->pluck('value', 'key')->toArray();

        $contactSettings = Settings::where('group', 'contact')->pluck('value', 'key')->toArray();
        $heroSettings = Settings::where('group', 'hero')->pluck('value', 'key')->toArray();
        $services = Service::where('is_active', true)->orderBy('sort_order')->get();
        $projects = Project::whereNotNull('slug')->latest()->take(6)->get();

        $cityName = $cityConfig['name'];
        $title = $pillarContent[$settingsGroup . '_title'] ?? "Construction Company {$cityName} | Blue Draft";
        $metaDesc = $pillarContent[$settingsGroup . '_meta_description'] ?? "Premier construction company in {$cityName}. Kitchen remodeling, bathroom renovation, commercial construction.";
        $heroTitle = $pillarContent[$settingsGroup . '_hero_title'] ?? "Construction Company {$cityName}";
        $heroSubtitle = $pillarContent[$settingsGroup . '_hero_subtitle'] ?? "Premium Construction Services in {$cityName}";
        $content = $pillarContent[$settingsGroup . '_content'] ?? "<p>Blue Draft offers expert construction and renovation services in {$cityName}. Contact us for a free estimate.</p>";

        return view('pages.pillar-city', [
            'contact' => [
                'phone' => $contactSettings['contact_phone'] ?? '+1.3476366128',
                'phone_link' => str_replace(['.', ' ', '-'], '', $contactSettings['contact_phone'] ?? '13476366128'),
                'address' => $contactSettings['contact_address'] ?? '358 Amboy St, Brooklyn',
            ],
            'hero' => ['cta_text' => $heroSettings['hero_cta_text'] ?? 'Get Your Free Quote'],
            'city' => $city,
            'cityName' => $cityName,
            'title' => $title,
            'metaDescription' => $metaDesc,
            'heroTitle' => $heroTitle,
            'heroSubtitle' => $heroSubtitle,
            'content' => $content,
            'services' => $services,
            'projects' => $projects,
        ]);
    }
}
