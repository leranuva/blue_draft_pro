<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Pillar Districts (SEO Local - Construction Company Pages)
    |--------------------------------------------------------------------------
    | NYC boroughs + New Jersey. NYC general uses pillar_nyc and has its own route.
    | Each district gets /construction-company-{slug} (e.g. construction-company-manhattan).
    */
    'cities' => [
        'manhattan' => [
            'name' => 'Manhattan',
            'calculator_borough' => 'manhattan',
            'context' => 'co-ops, condos, luxury apartments',
            'building_regulations' => [
                'NYC DOB permits',
                'Co-op board approval packages',
                'Building insurance requirements',
                'Work hour compliance',
            ],
            'faqs' => [
                ['question' => 'How long does a renovation take in Manhattan?', 'answer' => 'Most Manhattan apartment renovations take between 5 and 10 weeks depending on scope and building requirements. Kitchen remodels typically run 6–8 weeks; full apartment renovations 12–24 weeks.'],
                ['question' => 'Do I need permits for renovation in Manhattan?', 'answer' => 'Yes, many projects require NYC Department of Buildings (DOB) permits. Co-op and condo buildings often require board approval before work begins. We handle permit applications and board packages.'],
            ],
        ],
        'brooklyn' => [
            'name' => 'Brooklyn',
            'calculator_borough' => 'brooklyn',
            'context' => 'brownstones, townhouses, duplex',
            'building_regulations' => [
                'NYC DOB permits',
                'Landmark district approvals (where applicable)',
                'Building insurance requirements',
                'Brownstone structural considerations',
            ],
            'faqs' => [
                ['question' => 'How long does a renovation take in Brooklyn?', 'answer' => 'Brooklyn renovations typically take 5–9 weeks for kitchen or bathroom projects, and 10–20 weeks for full brownstone or apartment renovations. Brownstones may require additional time for structural work.'],
                ['question' => 'Do I need permits for renovation in Brooklyn?', 'answer' => 'Yes. NYC DOB permits are required for most renovation work. Brownstones and landmark districts may have additional requirements. We manage all permit applications.'],
            ],
        ],
        'queens' => [
            'name' => 'Queens',
            'calculator_borough' => 'queens',
            'context' => 'houses, larger apartments',
            'building_regulations' => [
                'NYC DOB permits',
                'Building insurance requirements',
                'Work hour compliance',
                'Zoning considerations for house expansions',
            ],
            'faqs' => [
                ['question' => 'How long does a renovation take in Queens?', 'answer' => 'Queens renovations typically take 4–7 weeks for kitchen or bathroom projects, and 10–18 weeks for full house or apartment renovations. Larger homes may extend the timeline.'],
                ['question' => 'Do I need permits for renovation in Queens?', 'answer' => 'Yes. NYC DOB permits are required. House expansions or structural changes may require zoning review. We handle all permit and approval processes.'],
            ],
        ],
        'bronx' => [
            'name' => 'The Bronx',
            'calculator_borough' => 'bronx',
            'context' => 'family homes',
            'building_regulations' => [
                'NYC DOB permits',
                'Building insurance requirements',
                'Work hour compliance',
            ],
            'faqs' => [
                ['question' => 'How long does a renovation take in the Bronx?', 'answer' => 'Bronx renovations typically take 4–7 weeks for kitchen or bathroom projects, and 10–18 weeks for full home renovations. Family homes often have simpler approval processes.'],
                ['question' => 'Do I need permits for renovation in the Bronx?', 'answer' => 'Yes. NYC DOB permits are required for most renovation work. We manage permit applications and ensure compliance with all building codes.'],
            ],
        ],
        'new-jersey' => [
            'name' => 'New Jersey',
            'calculator_borough' => 'nj',
            'context' => 'suburban homes, condos',
            'building_regulations' => [
                'Local municipal permits',
                'Building insurance requirements',
                'HOA approvals (where applicable)',
            ],
            'faqs' => [
                ['question' => 'How long does a renovation take in New Jersey?', 'answer' => 'New Jersey renovations typically take 4–7 weeks for kitchen or bathroom projects, and 10–22 weeks for full home renovations. Permit timelines vary by municipality.'],
                ['question' => 'Do I need permits for renovation in New Jersey?', 'answer' => 'Yes. Permits are required and vary by municipality. HOA communities may have additional approval requirements. We handle all permit and approval processes.'],
            ],
        ],
    ],
];
