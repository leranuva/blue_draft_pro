<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class NumberServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Monkey patch Number::format() para que funcione sin intl
        if (!extension_loaded('intl')) {
            // Interceptar las llamadas a Number::format() usando un alias
            $this->app->bind('Illuminate\Support\Number', function () {
                return new class {
                    public static function format($number, $locale = null, $precision = null, $maxPrecision = null) {
                        if ($precision !== null) {
                            return number_format($number, $precision, '.', ',');
                        }
                        return number_format($number, 0, '.', ',');
                    }
                };
            });
        }
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

