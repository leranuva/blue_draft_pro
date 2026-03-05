<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Email Sequence (Lead Nurturing)
    |--------------------------------------------------------------------------
    |
    | Configure the automated email sequence for new leads.
    | Integrate with Brevo (Sendinblue) or ActiveCampaign via API.
    |
    */

    'enabled' => env('EMAIL_SEQUENCE_ENABLED', true),

    'provider' => env('EMAIL_SEQUENCE_PROVIDER', 'brevo'), // brevo, activecampaign

    'brevo' => [
        'api_key' => env('BREVO_API_KEY'),
        'list_id' => env('BREVO_LIST_ID'),
        'template_ids' => [
            1 => env('BREVO_TEMPLATE_1'), // Inmediato
            2 => env('BREVO_TEMPLATE_2'), // 24h
            3 => env('BREVO_TEMPLATE_3'), // 3 días
            4 => env('BREVO_TEMPLATE_4'), // 7 días
            5 => env('BREVO_TEMPLATE_5'), // Case Study
            6 => env('BREVO_TEMPLATE_6'), // Objection Crusher
        ],
    ],

    'delays' => [
        1 => 0,       // Inmediato
        2 => 24,      // 24 horas
        3 => 72,      // 3 días
        4 => 168,     // 7 días (en horas)
        5 => 240,     // 10 días
        6 => 336,     // 14 días
    ],

];
