<?php

namespace App\Support;

use Illuminate\Support\Number as BaseNumber;

/**
 * Helper class to extend Number with fallback for missing intl extension
 */
class NumberHelper
{
    /**
     * Format a number safely, using intl if available or basic formatting if not
     */
    public static function formatSafe($number, $locale = null): string
    {
        if (extension_loaded('intl')) {
            try {
                return BaseNumber::format($number, locale: $locale ?? app()->getLocale());
            } catch (\RuntimeException $e) {
                // Fallback to basic formatting
                return number_format($number, 0, '.', ',');
            }
        }
        
        return number_format($number, 0, '.', ',');
    }
}

