<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class SiteSettings extends Page
{
    protected string $view = 'filament.pages.site-settings';
    
    public static function shouldRegisterNavigation(): bool
    {
        return false; // Ocultar de la navegación, las configuraciones están en el menú desplegable
    }
}
