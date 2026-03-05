<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Type × Borough Multipliers (NYC Market)
    |--------------------------------------------------------------------------
    | Kitchen in Manhattan ≠ Basement in Manhattan. Per-type sensitivity.
    | Fallback: borough_multipliers if type not in matrix.
    */
    'type_borough_multipliers' => [
        'kitchen' => ['manhattan' => 1.35, 'brooklyn' => 1.18, 'queens' => 1.08, 'bronx' => 0.98, 'nj' => 1.00],
        'bathroom' => ['manhattan' => 1.32, 'brooklyn' => 1.15, 'queens' => 1.05, 'bronx' => 0.95, 'nj' => 1.00],
        'basement' => ['manhattan' => 1.20, 'brooklyn' => 1.10, 'queens' => 1.02, 'bronx' => 0.92, 'nj' => 1.00],
        'whole_house' => ['manhattan' => 1.28, 'brooklyn' => 1.12, 'queens' => 1.04, 'bronx' => 0.94, 'nj' => 1.00],
        'commercial' => ['manhattan' => 1.25, 'brooklyn' => 1.12, 'queens' => 1.03, 'bronx' => 0.93, 'nj' => 1.00],
    ],

    /*
    |--------------------------------------------------------------------------
    | Borough Multipliers (fallback when type not in matrix)
    |--------------------------------------------------------------------------
    */
    'borough_multipliers' => [
        'manhattan' => 1.30,
        'brooklyn' => 1.15,
        'queens' => 1.05,
        'bronx' => 0.95,
        'nj' => 1.00,
    ],

    /*
    |--------------------------------------------------------------------------
    | Sqft Scale Adjustment
    |--------------------------------------------------------------------------
    | Small projects: higher cost/sqft. Large: economies of scale.
    | < 150 sqft: +10%, > 800 sqft: -8%
    */
    'sqft_adjustments' => [
        'small_threshold' => 150,
        'small_multiplier' => 1.10,
        'large_threshold' => 800,
        'large_multiplier' => 0.92,
    ],

    /*
    |--------------------------------------------------------------------------
    | Finish Level Multipliers
    |--------------------------------------------------------------------------
    */
    'finish_multipliers' => [
        'basic' => 0.9,
        'standard' => 1.0,
        'premium' => 1.25,
    ],

    /*
    |--------------------------------------------------------------------------
    | Base Price Ranges (USD per sq ft) — Before borough/finish
    |--------------------------------------------------------------------------
    */
    'price_ranges' => [
        'kitchen' => ['min' => 150, 'max' => 350],
        'bathroom' => ['min' => 100, 'max' => 250],
        'basement' => ['min' => 50, 'max' => 150],
        'whole_house' => ['min' => 80, 'max' => 200],
        'commercial' => ['min' => 60, 'max' => 180],
    ],

    /*
    |--------------------------------------------------------------------------
    | Average Project Timeline (weeks) by Type (fallback)
    |--------------------------------------------------------------------------
    */
    'timelines' => [
        'kitchen' => '6–10 weeks',
        'bathroom' => '3–6 weeks',
        'basement' => '4–8 weeks',
        'whole_house' => '12–24 weeks',
        'commercial' => '8–16 weeks',
    ],

    /*
    |--------------------------------------------------------------------------
    | Dynamic Timeline (Type × Borough × Finish) — More precise
    |--------------------------------------------------------------------------
    | Format: type => [borough => [finish => 'X–Y weeks']]
    | Fallback: timelines[type] if not found
    */
    'timelines_dynamic' => [
        'kitchen' => [
            'manhattan' => ['basic' => '5–7 weeks', 'standard' => '6–8 weeks', 'premium' => '7–10 weeks'],
            'brooklyn' => ['basic' => '5–7 weeks', 'standard' => '6–8 weeks', 'premium' => '7–9 weeks'],
            'queens' => ['basic' => '4–6 weeks', 'standard' => '5–7 weeks', 'premium' => '6–8 weeks'],
            'bronx' => ['basic' => '4–6 weeks', 'standard' => '5–7 weeks', 'premium' => '6–8 weeks'],
            'nj' => ['basic' => '4–6 weeks', 'standard' => '5–7 weeks', 'premium' => '6–8 weeks'],
        ],
        'bathroom' => [
            'manhattan' => ['basic' => '3–4 weeks', 'standard' => '4–5 weeks', 'premium' => '5–7 weeks'],
            'brooklyn' => ['basic' => '3–4 weeks', 'standard' => '4–5 weeks', 'premium' => '5–6 weeks'],
            'queens' => ['basic' => '3–4 weeks', 'standard' => '4–5 weeks', 'premium' => '5–6 weeks'],
            'bronx' => ['basic' => '3–4 weeks', 'standard' => '4–5 weeks', 'premium' => '5–6 weeks'],
            'nj' => ['basic' => '3–4 weeks', 'standard' => '4–5 weeks', 'premium' => '5–6 weeks'],
        ],
        'basement' => [
            'manhattan' => ['basic' => '4–6 weeks', 'standard' => '5–7 weeks', 'premium' => '6–9 weeks'],
            'brooklyn' => ['basic' => '4–6 weeks', 'standard' => '5–7 weeks', 'premium' => '6–8 weeks'],
            'queens' => ['basic' => '4–5 weeks', 'standard' => '5–6 weeks', 'premium' => '6–8 weeks'],
            'bronx' => ['basic' => '4–5 weeks', 'standard' => '5–6 weeks', 'premium' => '6–7 weeks'],
            'nj' => ['basic' => '4–5 weeks', 'standard' => '5–6 weeks', 'premium' => '6–8 weeks'],
        ],
        'whole_house' => [
            'manhattan' => ['basic' => '12–18 weeks', 'standard' => '16–22 weeks', 'premium' => '20–28 weeks'],
            'brooklyn' => ['basic' => '10–16 weeks', 'standard' => '14–20 weeks', 'premium' => '18–24 weeks'],
            'queens' => ['basic' => '10–14 weeks', 'standard' => '12–18 weeks', 'premium' => '16–22 weeks'],
            'bronx' => ['basic' => '10–14 weeks', 'standard' => '12–18 weeks', 'premium' => '16–20 weeks'],
            'nj' => ['basic' => '10–14 weeks', 'standard' => '12–18 weeks', 'premium' => '16–22 weeks'],
        ],
        'commercial' => [
            'manhattan' => ['basic' => '5–8 weeks', 'standard' => '7–10 weeks', 'premium' => '10–14 weeks'],
            'brooklyn' => ['basic' => '5–7 weeks', 'standard' => '6–9 weeks', 'premium' => '9–12 weeks'],
            'queens' => ['basic' => '4–6 weeks', 'standard' => '6–8 weeks', 'premium' => '8–11 weeks'],
            'bronx' => ['basic' => '4–6 weeks', 'standard' => '5–8 weeks', 'premium' => '8–10 weeks'],
            'nj' => ['basic' => '4–6 weeks', 'standard' => '6–8 weeks', 'premium' => '8–12 weeks'],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Typical Market Ranges (Type × Borough) — For context
    |--------------------------------------------------------------------------
    | "Typical kitchen renovation in Brooklyn: $30k–$60k" — User sees if their estimate falls within range
    */
    'typical_ranges' => [
        'kitchen' => ['manhattan' => [30000, 90000], 'brooklyn' => [25000, 70000], 'queens' => [22000, 60000], 'bronx' => [20000, 55000], 'nj' => [22000, 65000]],
        'bathroom' => ['manhattan' => [18000, 50000], 'brooklyn' => [15000, 42000], 'queens' => [14000, 38000], 'bronx' => [12000, 35000], 'nj' => [14000, 40000]],
        'basement' => ['manhattan' => [25000, 70000], 'brooklyn' => [20000, 55000], 'queens' => [18000, 50000], 'bronx' => [16000, 45000], 'nj' => [18000, 52000]],
        'whole_house' => ['manhattan' => [80000, 250000], 'brooklyn' => [65000, 200000], 'queens' => [60000, 180000], 'bronx' => [55000, 160000], 'nj' => [60000, 190000]],
        'commercial' => ['manhattan' => [50000, 180000], 'brooklyn' => [40000, 140000], 'queens' => [35000, 120000], 'bronx' => [30000, 110000], 'nj' => [35000, 130000]],
    ],

    /*
    |--------------------------------------------------------------------------
    | Borough Insights (for display) — "Renovation trends in Queens"
    |--------------------------------------------------------------------------
    */
    'borough_insights' => [
        'manhattan' => ['avg_kitchen' => 52000, 'avg_sqft' => 420, 'avg_timeline' => '7 weeks', 'popular_finish' => 'premium'],
        'brooklyn' => ['avg_kitchen' => 42000, 'avg_sqft' => 380, 'avg_timeline' => '6 weeks', 'popular_finish' => 'standard'],
        'queens' => ['avg_kitchen' => 38000, 'avg_sqft' => 400, 'avg_timeline' => '5 weeks', 'popular_finish' => 'standard'],
        'bronx' => ['avg_kitchen' => 35000, 'avg_sqft' => 360, 'avg_timeline' => '5 weeks', 'popular_finish' => 'basic'],
        'nj' => ['avg_kitchen' => 40000, 'avg_sqft' => 390, 'avg_timeline' => '6 weeks', 'popular_finish' => 'standard'],
    ],

    /*
    |--------------------------------------------------------------------------
    | Similar Project Examples (for trust)
    |--------------------------------------------------------------------------
    | Shown below estimate to show "real" projects
    */
    'similar_project_examples' => [
        ['type' => 'kitchen', 'borough' => 'brooklyn', 'title' => 'Kitchen Renovation', 'location' => 'Brooklyn Heights', 'cost' => 45000, 'timeline' => '6 weeks'],
        ['type' => 'bathroom', 'borough' => 'manhattan', 'title' => 'Bathroom Renovation', 'location' => 'Upper East Side', 'cost' => 38000, 'timeline' => '5 weeks'],
        ['type' => 'kitchen', 'borough' => 'queens', 'title' => 'Kitchen Remodel', 'location' => 'Astoria', 'cost' => 32000, 'timeline' => '5 weeks'],
        ['type' => 'basement', 'borough' => 'brooklyn', 'title' => 'Basement Finishing', 'location' => 'Park Slope', 'cost' => 52000, 'timeline' => '7 weeks'],
        ['type' => 'bathroom', 'borough' => 'queens', 'title' => 'Bathroom Renovation', 'location' => 'Flushing', 'cost' => 28000, 'timeline' => '4 weeks'],
    ],

    /*
    |--------------------------------------------------------------------------
    | Margin / Cost (internal) — Type × Borough
    |--------------------------------------------------------------------------
    | Kitchen Manhattan: más complejidad, supervisión, riesgo → mayor cost ratio
    | Basement Bronx: más simple, menos permisos → menor cost ratio
    | internal_cost = estimated_value × cost_ratio
    | expected_margin = estimated_value - internal_cost
    */
    'cost_ratio' => 0.75,  // fallback
    'cost_ratio_type_borough' => [
        'kitchen' => ['manhattan' => 0.78, 'brooklyn' => 0.76, 'queens' => 0.74, 'bronx' => 0.72, 'nj' => 0.74],
        'bathroom' => ['manhattan' => 0.77, 'brooklyn' => 0.75, 'queens' => 0.73, 'bronx' => 0.71, 'nj' => 0.73],
        'basement' => ['manhattan' => 0.70, 'brooklyn' => 0.68, 'queens' => 0.67, 'bronx' => 0.65, 'nj' => 0.67],
        'whole_house' => ['manhattan' => 0.76, 'brooklyn' => 0.74, 'queens' => 0.72, 'bronx' => 0.70, 'nj' => 0.72],
        'commercial' => ['manhattan' => 0.75, 'brooklyn' => 0.73, 'queens' => 0.71, 'bronx' => 0.69, 'nj' => 0.71],
    ],

    /*
    |--------------------------------------------------------------------------
    | Confidence Text (social proof)
    |--------------------------------------------------------------------------
    */
    'confidence_text' => 'Based on 120+ NYC renovation projects completed.',
    'urgency_text' => 'Pricing updated quarterly to reflect NYC material costs.',
    'breakdown_pct' => ['labor' => 55, 'materials' => 30, 'permits' => 8, 'management' => 7],

    /*
    |--------------------------------------------------------------------------
    | Algorithm Version (for analytics)
    |--------------------------------------------------------------------------
    */
    'algorithm_version' => '2.1',

];
