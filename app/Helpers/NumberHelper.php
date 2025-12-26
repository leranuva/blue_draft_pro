<?php

if (!function_exists('format_number_safe')) {
    /**
     * Formatea un número de forma segura, usando intl si está disponible
     * o formateo básico si no lo está
     */
    function format_number_safe($number, $locale = null): string
    {
        if (extension_loaded('intl')) {
            try {
                return \Illuminate\Support\Number::format($number, locale: $locale ?? app()->getLocale());
            } catch (\Exception $e) {
                // Fallback a formateo básico
                return number_format($number, 0, '.', ',');
            }
        }
        
        return number_format($number, 0, '.', ',');
    }
}
