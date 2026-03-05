<?php

namespace App\Filament\Pages;

use App\Models\Settings;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Storage;

class AboutSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected string $view = 'filament.pages.about-settings';
    
    public static function getNavigationLabel(): string
    {
        return 'About Settings';
    }
    
    public static function getNavigationGroup(): ?string
    {
        return 'Site Settings';
    }
    
    public static function getNavigationIcon(): ?string
    {
        return 'heroicon-o-information-circle';
    }
    
    public static function getNavigationSort(): ?int
    {
        return 2;
    }

    public ?array $data = [];

    public function mount(): void
    {
        $aboutSettings = Settings::where('group', 'about')
            ->pluck('value', 'key')
            ->toArray();

        $this->form->fill($aboutSettings);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('About Header')
                    ->description('Configure the header section of About')
                    ->schema([
                        TextInput::make('about_badge')
                            ->label('Badge Text')
                            ->placeholder('About Us')
                            ->maxLength(255),
                        TextInput::make('about_title')
                            ->label('Title')
                            ->placeholder('About Blue Draft Company')
                            ->maxLength(255),
                    ])
                    ->columns(2),
                
                Section::make('Mission Content')
                    ->description('Main content of the About section')
                    ->schema([
                        TextInput::make('about_subtitle')
                            ->label('Subtitle')
                            ->placeholder('Our Mission')
                            ->maxLength(255),
                        Textarea::make('about_description_1')
                            ->label('Description Paragraph 1')
                            ->rows(4)
                            ->placeholder('At Blue Draft Construction Company, our mission is...')
                            ->columnSpanFull(),
                        Textarea::make('about_description_2')
                            ->label('Description Paragraph 2')
                            ->rows(4)
                            ->placeholder('With years of experience in the construction industry...')
                            ->columnSpanFull(),
                    ])
                    ->columns(1),
                
                Section::make('Statistics')
                    ->description('Company statistics displayed in the About section')
                    ->schema([
                        TextInput::make('about_stat_years')
                            ->label('Years Experience')
                            ->placeholder('15+')
                            ->maxLength(50),
                        TextInput::make('about_stat_projects')
                            ->label('Projects Completed')
                            ->placeholder('200+')
                            ->maxLength(50),
                        TextInput::make('about_stat_satisfaction')
                            ->label('Satisfaction Rate')
                            ->placeholder('100%')
                            ->maxLength(50),
                        TextInput::make('about_stat_rating')
                            ->label('Average Rating (e.g. 4.9/5)')
                            ->placeholder('4.9/5')
                            ->maxLength(20),
                        TextInput::make('about_stat_borough')
                            ->label('Borough Social Proof')
                            ->placeholder('+127 Renovations in Brooklyn Since 2019')
                            ->helperText('High-converting stat: projects in a specific borough. Leave empty to hide.')
                            ->maxLength(100),
                    ])
                    ->columns(2),
                
                Section::make('About Image')
                    ->description('Image for the right side of the About section')
                    ->schema([
                        FileUpload::make('about_image')
                            ->label('About Image')
                            ->image()
                            ->disk('public')
                            ->directory('settings')
                            ->visibility('public')
                            ->imageEditor()
                            ->maxSize(10240)
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp', 'image/jpg'])
                            ->downloadable()
                            ->previewable()
                            ->openable()
                            ->deletable()
                            ->helperText('Image for the right side of the About section'),
                    ])
                    ->columns(1),
                
                Section::make('Placeholder Content')
                    ->description('SVG icon and text for the placeholder when no image is set')
                    ->schema([
                        TextInput::make('about_image_text')
                            ->label('Placeholder Text')
                            ->placeholder('Quality & Safety')
                            ->maxLength(255),
                        Textarea::make('about_image_svg_path')
                            ->label('SVG Path')
                            ->rows(4)
                            ->placeholder('M9 12l2 2 4-4m5.618-4.016A11.955...')
                            ->helperText('SVG path data for the icon'),
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
            // Handle file uploads
            if ($key === 'about_image' && is_array($value)) {
                if (!empty($value)) {
                    $value = $value[0];
                } else {
                    // Keep existing value if no new file uploaded
                    $existing = Settings::where('key', $key)->first();
                    $value = $existing ? $existing->value : null;
                }
            }

            // Delete old file if new one is uploaded
            if ($key === 'about_image' && $value) {
                $existing = Settings::where('key', $key)->first();
                if ($existing && $existing->value && $existing->value !== $value) {
                    Storage::disk('public')->delete($existing->value);
                }
            }

            Settings::updateOrCreate(
                ['key' => $key],
                [
                    'value' => $value,
                    'type' => $key === 'about_image' ? 'image' : 
                             (in_array($key, ['about_description_1', 'about_description_2', 'about_image_svg_path']) ? 'textarea' : 'text'),
                    'group' => 'about',
                ]
            );
        }

        Notification::make()
            ->title('About settings saved successfully')
            ->success()
            ->send();
    }
}


