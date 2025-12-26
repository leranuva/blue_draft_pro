<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

class CustomDashboard extends BaseDashboard
{
    protected string $view = 'filament.pages.custom-dashboard';
    
    public static function getNavigationIcon(): ?string
    {
        return 'heroicon-o-home';
    }
    
    public function getTitle(): string
    {
        return 'Dashboard';
    }
    
    public function getHeading(): string
    {
        return 'Welcome to Administration Panel';
    }
}

