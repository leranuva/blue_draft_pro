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

class FooterSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected string $view = 'filament.pages.footer-settings';
    
    public static function getNavigationLabel(): string
    {
        return 'Footer Settings';
    }
    
    public static function getNavigationGroup(): ?string
    {
        return 'Site Settings';
    }
    
    public static function getNavigationIcon(): ?string
    {
        return 'heroicon-o-arrow-down-tray';
    }
    
    public static function getNavigationSort(): ?int
    {
        return 8; // Aparecer después de Contact Settings (que tiene orden 7)
    }

    public ?array $data = [];

    public function mount(): void
    {
        $footerSettings = Settings::where('group', 'footer')
            ->pluck('value', 'key')
            ->toArray();

        $this->form->fill($footerSettings);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Footer Description')
                    ->description('Main description in the footer')
                    ->schema([
                        Textarea::make('footer_description')
                            ->label('Description')
                            ->rows(3)
                            ->placeholder('Expert Construction Solutions You Can Trust. Reliable construction services for your dream projects.')
                            ->columnSpanFull(),
                    ])
                    ->columns(1),
                
                Section::make('Contact Information')
                    ->description('Contact details in the footer')
                    ->schema([
                        TextInput::make('footer_address')
                            ->label('Address')
                            ->placeholder('358 Amboy St, Brooklyn, NY 11212, USA')
                            ->maxLength(255),
                        TextInput::make('footer_email_1')
                            ->label('Email 1')
                            ->placeholder('info@bluedraft.cc')
                            ->email()
                            ->maxLength(255),
                        TextInput::make('footer_email_2')
                            ->label('Email 2')
                            ->placeholder('info@bluedraft.cc')
                            ->email()
                            ->maxLength(255),
                        TextInput::make('footer_phone')
                            ->label('Phone Number')
                            ->placeholder('+1.3476366128')
                            ->maxLength(255),
                    ])
                    ->columns(2),
                
                Section::make('Social Media Links')
                    ->description('Social media URLs')
                    ->schema([
                        TextInput::make('footer_linkedin_url')
                            ->label('LinkedIn URL')
                            ->placeholder('https://www.linkedin.com/company/bluedraft')
                            ->url()
                            ->maxLength(255),
                        TextInput::make('footer_instagram_url')
                            ->label('Instagram URL')
                            ->placeholder('https://www.instagram.com/bluedraft')
                            ->url()
                            ->maxLength(255),
                        TextInput::make('footer_facebook_url')
                            ->label('Facebook URL')
                            ->placeholder('https://www.facebook.com/bluedraft')
                            ->url()
                            ->maxLength(255),
                    ])
                    ->columns(1),
                
                Section::make('Authority & Trust')
                    ->description('License, insurance, certifications - increases conversion 30-40%')
                    ->schema([
                        TextInput::make('footer_license')
                            ->label('License Number')
                            ->placeholder('NYC License #12345')
                            ->helperText('NYC contractor license. Leave empty to hide.')
                            ->maxLength(100),
                        TextInput::make('footer_insured')
                            ->label('Insurance')
                            ->placeholder('Fully insured & bonded')
                            ->helperText('e.g. Fully insured & bonded')
                            ->maxLength(100),
                        TextInput::make('footer_certifications')
                            ->label('Certifications')
                            ->placeholder('EPA Lead-Safe, OSHA')
                            ->helperText('Comma-separated. Leave empty to hide.')
                            ->maxLength(255),
                    ])
                    ->columns(1),
                
                Section::make('Copyright')
                    ->description('Copyright text')
                    ->schema([
                        TextInput::make('footer_copyright')
                            ->label('Copyright Text')
                            ->placeholder('Blue Draft - All Rights Reserved.')
                            ->helperText('The year will be added automatically')
                            ->maxLength(255),
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
                    'type' => $key === 'footer_description' ? 'textarea' : 'text',
                    'group' => 'footer',
                ]
            );
        }

        Notification::make()
            ->title('Footer settings saved successfully')
            ->success()
            ->send();
    }
}

