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

class HeroSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected string $view = 'filament.pages.hero-settings';
    
    public static function getNavigationLabel(): string
    {
        return 'Hero Settings';
    }
    
    public static function getNavigationGroup(): ?string
    {
        return 'Site Settings';
    }
    
    public static function getNavigationIcon(): ?string
    {
        return 'heroicon-o-photo';
    }
    
    public static function getNavigationSort(): ?int
    {
        return 1;
    }

    public ?array $data = [];

    public function mount(): void
    {
        $heroSettings = Settings::where('group', 'hero')
            ->pluck('value', 'key')
            ->toArray();

        $this->form->fill($heroSettings);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Hero Content')
                    ->description('Configure the main hero section content')
                    ->schema([
                        TextInput::make('hero_badge')
                            ->label('Badge Text')
                            ->placeholder('Expert Construction')
                            ->maxLength(255),
                        TextInput::make('hero_title_line1')
                            ->label('Title Line 1')
                            ->placeholder('Solutions You')
                            ->maxLength(255),
                        TextInput::make('hero_title_line2')
                            ->label('Title Line 2')
                            ->placeholder('Can Trust')
                            ->maxLength(255),
                        TextInput::make('hero_subtitle')
                            ->label('Subtitle (direct value prop)')
                            ->placeholder('Free Estimates. On-Time Delivery. Guaranteed Quality.')
                            ->helperText('Short punchy line: what you do, for whom. E.g. "Premium Construction in NYC"')
                            ->maxLength(255),
                        Textarea::make('hero_description')
                            ->label('Description')
                            ->rows(3)
                            ->placeholder('Reliable construction services...'),
                        TextInput::make('hero_cta_text')
                            ->label('CTA Button Text')
                            ->placeholder('Get Your Free Quote')
                            ->maxLength(255),
                    ])
                    ->columns(2),
                
                Section::make('Contact Information')
                    ->description('Phone numbers for the hero section')
                    ->schema([
                        TextInput::make('hero_phone')
                            ->label('Phone (for links)')
                            ->placeholder('+13476366128')
                            ->helperText('Phone number without formatting for tel: links')
                            ->maxLength(255),
                        TextInput::make('hero_phone_display')
                            ->label('Phone (for display)')
                            ->placeholder('+1.3476366128')
                            ->helperText('Formatted phone number to display')
                            ->maxLength(255),
                    ])
                    ->columns(2),
                
                Section::make('Hero Images')
                    ->description('Background and placeholder images')
                    ->schema([
                        FileUpload::make('hero_background_image')
                            ->label('Background Image')
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
                            ->helperText('Background image for the hero section'),
                        FileUpload::make('hero_placeholder_image')
                            ->label('Placeholder Image (Right Side)')
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
                            ->helperText('Image for the right side placeholder (will show with SVG overlay)'),
                    ])
                    ->columns(2),
                
                Section::make('Placeholder Content')
                    ->description('SVG icon and text for the placeholder when no image is set')
                    ->schema([
                        TextInput::make('hero_image_text')
                            ->label('Placeholder Text')
                            ->placeholder('Construction Excellence')
                            ->maxLength(255),
                        Textarea::make('hero_image_svg_path')
                            ->label('SVG Path')
                            ->rows(4)
                            ->placeholder('M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16...')
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
            if (in_array($key, ['hero_background_image', 'hero_placeholder_image']) && is_array($value)) {
                if (!empty($value)) {
                    $value = $value[0];
                } else {
                    // Keep existing value if no new file uploaded
                    $existing = Settings::where('key', $key)->first();
                    $value = $existing ? $existing->value : null;
                }
            }

            // Delete old file if new one is uploaded
            if (in_array($key, ['hero_background_image', 'hero_placeholder_image']) && $value) {
                $existing = Settings::where('key', $key)->first();
                if ($existing && $existing->value && $existing->value !== $value) {
                    Storage::disk('public')->delete($existing->value);
                }
            }

            Settings::updateOrCreate(
                ['key' => $key],
                [
                    'value' => $value,
                    'type' => in_array($key, ['hero_background_image', 'hero_placeholder_image']) ? 'image' : 
                             (in_array($key, ['hero_description', 'hero_image_svg_path']) ? 'textarea' : 'text'),
                    'group' => 'hero',
                ]
            );
        }

        Notification::make()
            ->title('Hero settings saved successfully')
            ->success()
            ->send();
    }
}
