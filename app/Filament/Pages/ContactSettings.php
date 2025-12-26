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

class ContactSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected string $view = 'filament.pages.contact-settings';
    
    public static function getNavigationLabel(): string
    {
        return 'Contact Settings';
    }
    
    public static function getNavigationGroup(): ?string
    {
        return 'Site Settings';
    }
    
    public static function getNavigationIcon(): ?string
    {
        return 'heroicon-o-envelope';
    }
    
    public static function getNavigationSort(): ?int
    {
        return 7; // Aparecer después de Quote Requests (que tiene orden 6)
    }

    public ?array $data = [];

    public function mount(): void
    {
        $contactSettings = Settings::where('group', 'contact')
            ->pluck('value', 'key')
            ->toArray();

        $this->form->fill($contactSettings);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Contact Header')
                    ->description('Configure the header section of Contact')
                    ->schema([
                        TextInput::make('contact_badge')
                            ->label('Badge Text')
                            ->placeholder('Get In Touch')
                            ->maxLength(255),
                        TextInput::make('contact_title')
                            ->label('Title')
                            ->placeholder('Contact Us')
                            ->maxLength(255),
                        Textarea::make('contact_description')
                            ->label('Description')
                            ->rows(2)
                            ->placeholder('Have questions? We\'re here to help. Reach out to us today.')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
                
                Section::make('Contact Information')
                    ->description('Contact details displayed in the Contact section')
                    ->schema([
                        TextInput::make('contact_address')
                            ->label('Address')
                            ->placeholder('Brooklyn, NY, United States')
                            ->maxLength(255),
                        TextInput::make('contact_phone')
                            ->label('Phone Number')
                            ->placeholder('+1.3476366128')
                            ->helperText('Formatted phone number for display')
                            ->maxLength(255),
                        TextInput::make('contact_phone_link')
                            ->label('Phone (for links)')
                            ->placeholder('+13476366128')
                            ->helperText('Phone number without formatting for tel: links')
                            ->maxLength(255),
                        TextInput::make('contact_email')
                            ->label('Email Address')
                            ->placeholder('marcin@bluedraft.org')
                            ->email()
                            ->maxLength(255),
                        TextInput::make('contact_hours')
                            ->label('Business Hours')
                            ->placeholder('Mon - Fri: 8:00 AM - 6:00 PM')
                            ->maxLength(255),
                    ])
                    ->columns(2),
                
                Section::make('Contact Form')
                    ->description('Form section title')
                    ->schema([
                        TextInput::make('contact_form_title')
                            ->label('Form Title')
                            ->placeholder('Send Us a Message')
                            ->maxLength(255),
                    ])
                    ->columns(1),
                
                Section::make('Google Maps')
                    ->description('Google Maps embed URL')
                    ->schema([
                        Textarea::make('contact_map_url')
                            ->label('Google Maps Embed URL')
                            ->rows(4)
                            ->placeholder('https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3024.184133583885!2d-73.94482368459418!3d40.67834397932778!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25bae6c5b3b3b%3A0x8b5e5e5e5e5e5e5e!2sBrooklyn%2C%20NY%2C%20USA!5e0!3m2!1sen!2sus!4v1234567890123!5m2!1sen!2sus')
                            ->helperText('Full Google Maps embed URL')
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
                    'type' => in_array($key, ['contact_description', 'contact_map_url']) ? 'textarea' : 'text',
                    'group' => 'contact',
                ]
            );
        }

        Notification::make()
            ->title('Contact settings saved successfully')
            ->success()
            ->send();
    }
}

