<?php

namespace App\Filament\Pages;

use App\Models\Settings;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class TestimonialsSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected string $view = 'filament.pages.testimonials-settings';
    
    public static function getNavigationLabel(): string
    {
        return 'Testimonials Settings';
    }
    
    public static function getNavigationGroup(): ?string
    {
        return 'Site Settings';
    }
    
    public static function getNavigationIcon(): ?string
    {
        return 'heroicon-o-chat-bubble-left-right';
    }
    
    public static function getNavigationSort(): ?int
    {
        return 5; // Aparecer después de Services Settings (que tiene orden 4)
    }

    public ?array $data = [];

    public function mount(): void
    {
        $testimonialsSettings = Settings::where('group', 'testimonials')
            ->pluck('value', 'key')
            ->toArray();

        $this->form->fill($testimonialsSettings);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Testimonials Header')
                    ->description('Configure the header section of Testimonials')
                    ->schema([
                        TextInput::make('testimonials_badge')
                            ->label('Badge Text')
                            ->placeholder('What Our Clients Say')
                            ->maxLength(255),
                        TextInput::make('testimonials_title')
                            ->label('Title')
                            ->placeholder('Client Testimonials')
                            ->maxLength(255),
                        Textarea::make('testimonials_description')
                            ->label('Description')
                            ->rows(2)
                            ->placeholder('Don\'t just take our word for it. See what our satisfied clients have to say about our work.')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
                
                Section::make('Testimonial 1')
                    ->description('First testimonial')
                    ->schema([
                        TextInput::make('testimonials_testimonial1_name')
                            ->label('Name')
                            ->placeholder('John & Sarah Martinez')
                            ->maxLength(255),
                        TextInput::make('testimonials_testimonial1_role')
                            ->label('Role')
                            ->placeholder('Homeowners')
                            ->maxLength(255),
                        TextInput::make('testimonials_testimonial1_project')
                            ->label('Project')
                            ->placeholder('Residential Renovation')
                            ->maxLength(255),
                        Select::make('testimonials_testimonial1_rating')
                            ->label('Rating')
                            ->options([
                                '1' => '1 Star',
                                '2' => '2 Stars',
                                '3' => '3 Stars',
                                '4' => '4 Stars',
                                '5' => '5 Stars',
                            ])
                            ->default('5')
                            ->required(),
                        TextInput::make('testimonials_testimonial1_image')
                            ->label('Image (Emoji)')
                            ->placeholder('👨‍👩‍👧')
                            ->maxLength(50)
                            ->helperText('Use an emoji or emoji code'),
                        Textarea::make('testimonials_testimonial1_text')
                            ->label('Testimonial Text')
                            ->rows(4)
                            ->placeholder('Blue Draft transformed our outdated kitchen...')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
                
                Section::make('Testimonial 2')
                    ->description('Second testimonial')
                    ->schema([
                        TextInput::make('testimonials_testimonial2_name')
                            ->label('Name')
                            ->placeholder('Michael Chen')
                            ->maxLength(255),
                        TextInput::make('testimonials_testimonial2_role')
                            ->label('Role')
                            ->placeholder('Business Owner')
                            ->maxLength(255),
                        TextInput::make('testimonials_testimonial2_project')
                            ->label('Project')
                            ->placeholder('Commercial Construction')
                            ->maxLength(255),
                        Select::make('testimonials_testimonial2_rating')
                            ->label('Rating')
                            ->options([
                                '1' => '1 Star',
                                '2' => '2 Stars',
                                '3' => '3 Stars',
                                '4' => '4 Stars',
                                '5' => '5 Stars',
                            ])
                            ->default('5')
                            ->required(),
                        TextInput::make('testimonials_testimonial2_image')
                            ->label('Image (Emoji)')
                            ->placeholder('👔')
                            ->maxLength(50)
                            ->helperText('Use an emoji or emoji code'),
                        Textarea::make('testimonials_testimonial2_text')
                            ->label('Testimonial Text')
                            ->rows(4)
                            ->placeholder('As a business owner, I needed a reliable construction partner...')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
                
                Section::make('Testimonial 3')
                    ->description('Third testimonial')
                    ->schema([
                        TextInput::make('testimonials_testimonial3_name')
                            ->label('Name')
                            ->placeholder('Emily Rodriguez')
                            ->maxLength(255),
                        TextInput::make('testimonials_testimonial3_role')
                            ->label('Role')
                            ->placeholder('Property Manager')
                            ->maxLength(255),
                        TextInput::make('testimonials_testimonial3_project')
                            ->label('Project')
                            ->placeholder('Multi-Unit Renovation')
                            ->maxLength(255),
                        Select::make('testimonials_testimonial3_rating')
                            ->label('Rating')
                            ->options([
                                '1' => '1 Star',
                                '2' => '2 Stars',
                                '3' => '3 Stars',
                                '4' => '4 Stars',
                                '5' => '5 Stars',
                            ])
                            ->default('5')
                            ->required(),
                        TextInput::make('testimonials_testimonial3_image')
                            ->label('Image (Emoji)')
                            ->placeholder('🏢')
                            ->maxLength(50)
                            ->helperText('Use an emoji or emoji code'),
                        Textarea::make('testimonials_testimonial3_text')
                            ->label('Testimonial Text')
                            ->rows(4)
                            ->placeholder('Working with Blue Draft was a pleasure from start to finish...')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
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
                    'type' => in_array($key, ['testimonials_description', 'testimonials_testimonial1_text', 'testimonials_testimonial2_text', 'testimonials_testimonial3_text']) ? 'textarea' : 'text',
                    'group' => 'testimonials',
                ]
            );
        }

        Notification::make()
            ->title('Testimonials settings saved successfully')
            ->success()
            ->send();
    }
}

