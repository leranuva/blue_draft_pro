<?php

namespace App\Providers;

use App\Models\Settings;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Number;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Monkey patch Number::format() para que funcione sin intl
        if (!extension_loaded('intl')) {
            // Sobrescribir el método format usando un alias
            $this->app->extend('number', function ($service, $app) {
                return new class {
                    public function format($number, $locale = null, $precision = null, $maxPrecision = null) {
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
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Crear un helper global para formatear números de forma segura
        if (!function_exists('format_number_safe')) {
            require_once app_path('Helpers/NumberHelper.php');
        }

        // Asegurar que APP_URL incluya el puerto correcto en desarrollo
        if (app()->environment('local') && request()->getPort()) {
            $url = request()->getSchemeAndHttpHost();
            if ($url !== config('app.url')) {
                config(['app.url' => $url]);
                config(['filesystems.disks.public.url' => $url . '/storage']);
            }
        }

        // Compartir datos del footer en todas las vistas
        try {
            $footerSettings = Settings::where('group', 'footer')
                ->pluck('value', 'key')
                ->toArray();

            View::share('footer', [
                'description' => $footerSettings['footer_description'] ?? 'Expert Construction Solutions You Can Trust. Reliable construction services for your dream projects.',
                'address' => $footerSettings['footer_address'] ?? '358 Amboy St, Brooklyn, NY 11212, USA',
                'email_1' => $footerSettings['footer_email_1'] ?? 'wojtek@bluedraft.org',
                'email_2' => $footerSettings['footer_email_2'] ?? 'marcin@bluedraft.org',
                'phone' => $footerSettings['footer_phone'] ?? '+1.3476366128',
                'linkedin_url' => $footerSettings['footer_linkedin_url'] ?? 'https://www.linkedin.com/company/bluedraft',
                'instagram_url' => $footerSettings['footer_instagram_url'] ?? 'https://www.instagram.com/bluedraft',
                'facebook_url' => $footerSettings['footer_facebook_url'] ?? 'https://www.facebook.com/bluedraft',
                'copyright' => $footerSettings['footer_copyright'] ?? 'Blue Draft - All Rights Reserved.',
            ]);
        } catch (\Exception $e) {
            // Si la tabla no existe aún, usar valores por defecto
            View::share('footer', [
                'description' => 'Expert Construction Solutions You Can Trust. Reliable construction services for your dream projects.',
                'address' => '358 Amboy St, Brooklyn, NY 11212, USA',
                'email_1' => 'wojtek@bluedraft.org',
                'email_2' => 'marcin@bluedraft.org',
                'phone' => '+1.3476366128',
                'linkedin_url' => 'https://www.linkedin.com/company/bluedraft',
                'instagram_url' => 'https://www.instagram.com/bluedraft',
                'facebook_url' => 'https://www.facebook.com/bluedraft',
                'copyright' => 'Blue Draft - All Rights Reserved.',
            ]);
        }
    }
}
