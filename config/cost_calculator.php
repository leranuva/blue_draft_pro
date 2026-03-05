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
    | Average Project Timeline (weeks) by Type
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
