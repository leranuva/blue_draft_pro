<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use App\Filament\Pages\HeroSettings;
use App\Filament\Pages\AboutSettings;
use App\Filament\Pages\ServicesSettings;
use App\Filament\Pages\TestimonialsSettings;
use App\Filament\Pages\ContactSettings;
use App\Filament\Pages\FooterSettings;
use App\Filament\Pages\CustomDashboard;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('system-bd-access') // URL personalizada y discreta
            ->login()
            ->brandName('Blue Draft Admin')
            ->colors([
                'primary' => Color::hex('#003366'), // Azul oscuro de Blue Draft
            ])
            ->brandLogo(asset('images/logo.svg'))
            ->favicon(asset('favicon.ico'))
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                CustomDashboard::class,
                HeroSettings::class,
                AboutSettings::class,
                ServicesSettings::class,
                TestimonialsSettings::class,
                ContactSettings::class,
                FooterSettings::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([
                // AccountWidget::class, // Temporalmente deshabilitado debido a error de compatibilidad
                // FilamentInfoWidget::class, // Temporalmente deshabilitado
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->spa(false); // Deshabilitar SPA para evitar problemas con intl
    }
}
