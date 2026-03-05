<?php

namespace App\Filament\Resources\Projects\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', \Illuminate\Support\Str::slug($state)))
                    ->label('Project Title'),
                TextInput::make('slug')
                    ->maxLength(255)
                    ->unique(ignoreRecord: true)
                    ->helperText('URL-friendly. Auto-generated from title.')
                    ->label('URL Slug'),
                Textarea::make('description')
                    ->rows(4)
                    ->columnSpanFull()
                    ->label('Description'),
                Select::make('category')
                    ->options([
                        'residential' => 'Residential',
                        'commercial' => 'Commercial',
                        'renovation' => 'Renovation',
                    ])
                    ->default('residential')
                    ->required()
                    ->label('Category'),
                FileUpload::make('image_before')
                    ->image()
                    ->disk('public')
                    ->directory('images/projects')
                    ->visibility('public')
                    ->imageEditor()
                    ->imageEditorAspectRatios([
                        null,
                        '16:9',
                        '4:3',
                        '1:1',
                    ])
                    ->label('Before Image')
                    ->helperText('Upload the "before" image for the project')
                    ->maxSize(5120)
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                    ->downloadable()
                    ->previewable()
                    ->openable()
                    ->deletable()
                    ->loadingIndicatorPosition('left')
                    ->panelAspectRatio('2:1'),
                FileUpload::make('image_after')
                    ->image()
                    ->disk('public')
                    ->directory('images/projects')
                    ->visibility('public')
                    ->imageEditor()
                    ->imageEditorAspectRatios([
                        null,
                        '16:9',
                        '4:3',
                        '1:1',
                    ])
                    ->label('After Image')
                    ->helperText('Upload the "after" image for the project')
                    ->maxSize(5120)
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                    ->downloadable()
                    ->previewable()
                    ->openable()
                    ->deletable()
                    ->loadingIndicatorPosition('left')
                    ->panelAspectRatio('2:1'),
                Toggle::make('is_featured')
                    ->label('Featured on Homepage')
                    ->helperText('Show this project on the homepage')
                    ->default(false),
            ]);
    }
}
