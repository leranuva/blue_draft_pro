<?php

namespace App\Filament\Resources\Settings\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class SettingsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('key')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true)
                    ->label('Setting Key')
                    ->helperText('Unique identifier for this setting (e.g., hero_title, contact_phone)'),
                Select::make('group')
                    ->options([
                        'general' => 'General',
                        'hero' => 'Hero Section',
                        'contact' => 'Contact Information',
                        'social' => 'Social Media',
                        'seo' => 'SEO',
                    ])
                    ->default('general')
                    ->required()
                    ->label('Group'),
                Select::make('type')
                    ->options([
                        'text' => 'Text',
                        'textarea' => 'Textarea',
                        'number' => 'Number',
                        'boolean' => 'Boolean',
                        'url' => 'URL',
                        'email' => 'Email',
                        'image' => 'Image',
                    ])
                    ->default('text')
                    ->required()
                    ->label('Type')
                    ->live(),
                FileUpload::make('value')
                    ->label('Image')
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
                    ->visible(fn ($get) => $get('type') === 'image')
                    ->columnSpanFull(),
                Textarea::make('value')
                    ->label('Value')
                    ->rows(3)
                    ->columnSpanFull()
                    ->visible(fn ($get) => $get('type') !== 'image'),
            ]);
    }
}
