<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CostCalculatorController extends Controller
{
    public function show(Request $request): View
    {
        $validBoroughs = ['manhattan', 'brooklyn', 'queens', 'bronx', 'nj'];
        $boroughParam = $request->query('borough', '');
        $defaultBorough = in_array($boroughParam, $validBoroughs) ? $boroughParam : 'manhattan';
        $contactSettings = Settings::where('group', 'contact')->pluck('value', 'key')->toArray();
        $heroSettings = Settings::where('group', 'hero')->pluck('value', 'key')->toArray();

        return view('pages.cost-calculator', [
            'contact' => [
                'phone' => $contactSettings['contact_phone'] ?? '+1.3476366128',
                'phone_link' => str_replace(['.', ' ', '-'], '', $contactSettings['contact_phone'] ?? '13476366128'),
                'whatsapp' => str_replace(['.', ' ', '-'], '', $contactSettings['contact_whatsapp'] ?? $contactSettings['contact_phone'] ?? '13476366128'),
            ],
            'hero' => [
                'cta_text' => $heroSettings['hero_cta_text'] ?? config('cta.default'),
                'cta_lock_estimate' => config('cta.calculator', 'Get Exact Quote for This Estimate — Free, No Obligation'),
            ],
            'priceRanges' => config('cost_calculator.price_ranges'),
            'typeBoroughMultipliers' => config('cost_calculator.type_borough_multipliers'),
            'boroughMultipliers' => config('cost_calculator.borough_multipliers'),
            'finishMultipliers' => config('cost_calculator.finish_multipliers'),
            'sqftAdjustments' => config('cost_calculator.sqft_adjustments'),
            'timelines' => config('cost_calculator.timelines'),
            'timelinesDynamic' => config('cost_calculator.timelines_dynamic', []),
            'typicalRanges' => config('cost_calculator.typical_ranges', []),
            'boroughInsights' => config('cost_calculator.borough_insights', []),
            'similarProjectExamples' => config('cost_calculator.similar_project_examples', []),
            'confidenceText' => config('cost_calculator.confidence_text'),
            'urgencyText' => config('cost_calculator.urgency_text'),
            'breakdownPct' => config('cost_calculator.breakdown_pct'),
            'algorithmVersion' => config('cost_calculator.algorithm_version'),
            'lockQuoteUrl' => route('home') . '?from=calculator',
            'defaultBorough' => $defaultBorough,
        ]);
    }
}
