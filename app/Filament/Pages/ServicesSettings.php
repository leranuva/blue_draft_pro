<?php

namespace App\Filament\Pages;

use App\Models\Settings;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ServicesSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected string $view = 'filament.pages.services-settings';
    
    public static function getNavigationLabel(): string
    {
        return 'Services Settings';
    }
    
    public static function getNavigationGroup(): ?string
    {
        return 'Site Settings';
    }
    
    public static function getNavigationIcon(): ?string
    {
        return 'heroicon-o-wrench-screwdriver';
    }
    
    public static function getNavigationSort(): ?int
    {
        return 4; // Aparecer después de Projects (que tiene orden 3)
    }

    public ?array $data = [];

    public function mount(): void
    {
        $servicesSettings = Settings::where('group', 'services')
            ->pluck('value', 'key')
            ->toArray();

        $this->form->fill($servicesSettings);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Services Header')
                    ->description('Configure the header section of Services')
                    ->schema([
                        TextInput::make('services_badge')
                            ->label('Badge Text')
                            ->placeholder('Our Services')
                            ->maxLength(255),
                        TextInput::make('services_title')
                            ->label('Title')
                            ->placeholder('What We Offer')
                            ->maxLength(255),
                        Textarea::make('services_description')
                            ->label('Description')
                            ->rows(2)
                            ->placeholder('Comprehensive construction solutions tailored to your needs')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
                
                Section::make('Service 1 - Residential Construction')
                    ->description('First service card')
                    ->schema([
                        TextInput::make('services_service1_title')
                            ->label('Title')
                            ->placeholder('Residential Construction')
                            ->maxLength(255),
                        Textarea::make('services_service1_description')
                            ->label('Description')
                            ->rows(3)
                            ->placeholder('From custom homes to renovations, we bring your residential vision to life...')
                            ->columnSpanFull(),
                        Textarea::make('services_service1_svg_path')
                            ->label('SVG Path')
                            ->rows(4)
                            ->placeholder('M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16...')
                            ->helperText('SVG path data for the icon')
                            ->columnSpanFull(),
                    ])
                    ->columns(1),
                
                Section::make('Service 2 - Commercial Projects')
                    ->description('Second service card')
                    ->schema([
                        TextInput::make('services_service2_title')
                            ->label('Title')
                            ->placeholder('Commercial Projects')
                            ->maxLength(255),
                        Textarea::make('services_service2_description')
                            ->label('Description')
                            ->rows(3)
                            ->placeholder('Professional commercial construction services for offices...')
                            ->columnSpanFull(),
                        Textarea::make('services_service2_svg_path')
                            ->label('SVG Path')
                            ->rows(4)
                            ->placeholder('M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16...')
                            ->helperText('SVG path data for the icon')
                            ->columnSpanFull(),
                    ])
                    ->columns(1),
                
                Section::make('Service 3 - Renovation & Remodeling')
                    ->description('Third service card')
                    ->schema([
                        TextInput::make('services_service3_title')
                            ->label('Title')
                            ->placeholder('Renovation & Remodeling')
                            ->maxLength(255),
                        Textarea::make('services_service3_description')
                            ->label('Description')
                            ->rows(3)
                            ->placeholder('Transform your existing space with expert renovation services...')
                            ->columnSpanFull(),
                        Textarea::make('services_service3_svg_path')
                            ->label('SVG Path')
                            ->rows(4)
                            ->placeholder('M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15')
                            ->helperText('SVG path data for the icon')
                            ->columnSpanFull(),
                    ])
                    ->columns(1),
            ])
            ->statePath('data');
    }

    protected function getFormActions(): array
    {
        return [
            \Filament\Actions\Action::make('save')
                ->label('Save Changes')
                ->submit('save'),
        ];
    }

    public function save(): void
    {
        $data = $this->form->getState();

        foreach ($data as $key => $value) {
            Settings::updateOrCreate(
                ['key' => $key],
                [
                    'value' => $value,
                    'type' => in_array($key, ['services_description', 'services_service1_description', 'services_service2_description', 'services_service3_description', 'services_service1_svg_path', 'services_service2_svg_path', 'services_service3_svg_path']) ? 'textarea' : 'text',
                    'group' => 'services',
                ]
            );
        }

        Notification::make()
            ->title('Services settings saved successfully')
            ->success()
            ->send();
    }
}

