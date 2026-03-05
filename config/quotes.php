<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Auto-assignment (assigned_to)
    |--------------------------------------------------------------------------
    |
    | Map borough or service_type to user ID for automatic lead assignment.
    | Set in .env: QUOTE_ASSIGN_BOROUGH_MANHATTAN=1, etc.
    |
    */

    'auto_assignment' => [
        'by_borough' => [
            'manhattan' => env('QUOTE_ASSIGN_BOROUGH_MANHATTAN'),
            'brooklyn' => env('QUOTE_ASSIGN_BOROUGH_BROOKLYN'),
            'queens' => env('QUOTE_ASSIGN_BOROUGH_QUEENS'),
            'bronx' => env('QUOTE_ASSIGN_BOROUGH_BRONX'),
            'staten_island' => env('QUOTE_ASSIGN_BOROUGH_STATEN_ISLAND'),
        ],
        'by_service' => [
            'commercial' => env('QUOTE_ASSIGN_SERVICE_COMMERCIAL'),
            'residential' => env('QUOTE_ASSIGN_SERVICE_RESIDENTIAL'),
            'renovation' => env('QUOTE_ASSIGN_SERVICE_RENOVATION'),
        ],
        'default' => env('QUOTE_ASSIGN_DEFAULT'),
    ],

];
