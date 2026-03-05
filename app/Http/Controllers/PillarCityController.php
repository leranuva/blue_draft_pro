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
        $cityName = is_array($cityConfig) ? ($cityConfig['name'] ?? $city) : $cityConfig;
        $calcBorough = $cityConfig['calculator_borough'] ?? $city;
        $settingsGroup = 'pillar_' . $city;
        $pillarContent = Settings::where('group', $settingsGroup)->pluck('value', 'key')->toArray();

        $contactSettings = Settings::where('group', 'contact')->pluck('value', 'key')->toArray();
        $heroSettings = Settings::where('group', 'hero')->pluck('value', 'key')->toArray();
        $services = Service::where('is_active', true)->orderBy('sort_order')->get();
        $projects = Project::whereNotNull('slug')->latest()->take(6)->get();

        $boroughInsights = config('cost_calculator.borough_insights', []);
        $typicalRanges = config('cost_calculator.typical_ranges', []);
        $insight = $boroughInsights[$calcBorough] ?? null;
        $typicalCosts = $this->buildTypicalCosts($typicalRanges, $calcBorough);

        $title = $pillarContent[$settingsGroup . '_title'] ?? "Renovation Contractor {$cityName} | Blue Draft";
        $metaDesc = $pillarContent[$settingsGroup . '_meta_description'] ?? "Premier renovation contractor in {$cityName}. Kitchen remodeling, bathroom renovation, apartment renovations. Free estimates.";
        $heroTitle = $pillarContent[$settingsGroup . '_hero_title'] ?? "Apartment Renovation Contractor in {$cityName}";
        $heroSubtitle = $pillarContent[$settingsGroup . '_hero_subtitle'] ?? "Licensed NYC contractors for kitchen, bathroom, and full apartment renovations in {$cityName}.";
        $content = $pillarContent[$settingsGroup . '_content'] ?? "<p>Blue Draft offers expert construction and renovation services in {$cityName}. Contact us for a free estimate.</p>";

        $calculatorUrl = route('cost-calculator') . '?borough=' . $calcBorough;
        $buildingRegulations = $cityConfig['building_regulations'] ?? [];
        $faqs = $cityConfig['faqs'] ?? [];
        $context = $cityConfig['context'] ?? '';

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
            'boroughInsight' => $insight,
            'typicalCosts' => $typicalCosts,
            'calculatorUrl' => $calculatorUrl,
            'buildingRegulations' => $buildingRegulations,
            'faqs' => $faqs,
            'context' => $context,
        ]);
    }

    private function buildTypicalCosts(array $typicalRanges, string $borough): array
    {
        $labels = [
            'kitchen' => 'Kitchen renovation',
            'bathroom' => 'Bathroom renovation',
            'basement' => 'Basement finishing',
            'whole_house' => 'Full apartment / whole house',
            'commercial' => 'Commercial renovation',
        ];
        $out = [];
        foreach ($typicalRanges as $type => $boroughs) {
            if (isset($boroughs[$borough])) {
                [$min, $max] = $boroughs[$borough];
                $out[] = [
                    'label' => $labels[$type] ?? $type,
                    'min' => $min,
                    'max' => $max,
                ];
            }
        }
        return $out;
    }
}
