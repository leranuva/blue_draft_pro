<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Google Tag Manager
    |--------------------------------------------------------------------------
    |
    | GTM container ID (e.g. GTM-XXXXXXX). When set, loads GTM and all
    | tracking is done via dataLayer. Configure GA4 and Meta Pixel inside GTM.
    |
    */

    'gtm_id' => env('GTM_ID'),

    /*
    |--------------------------------------------------------------------------
    | Google Analytics 4
    |--------------------------------------------------------------------------
    |
    | GA4 Measurement ID (e.g. G-XXXXXXXXXX). Used when GTM is not set.
    |
    */

    'ga4_id' => env('GA4_MEASUREMENT_ID'),

    /*
    |--------------------------------------------------------------------------
    | Meta Pixel (Facebook)
    |--------------------------------------------------------------------------
    |
    | Meta Pixel ID for remarketing. Used when GTM is not set.
    |
    */

    'meta_pixel_id' => env('META_PIXEL_ID'),

];
