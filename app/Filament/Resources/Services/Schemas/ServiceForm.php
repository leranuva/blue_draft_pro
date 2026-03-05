<?php

namespace App\Filament\Resources\Services\Schemas;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Basic Info')
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),
                        TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true)
                            ->helperText('URL-friendly identifier. Auto-generated from title.'),
                        Toggle::make('is_active')
                            ->default(true),
                        TextInput::make('sort_order')
                            ->numeric()
                            ->default(0),
                    ])
                    ->columns(2),

                Section::make('Hero')
                    ->schema([
                        TextInput::make('hero_title')
                            ->maxLength(255)
                            ->placeholder('Service title for hero'),
                        TextInput::make('hero_subtitle')
                            ->maxLength(255)
                            ->placeholder('Short subtitle'),
                    ])
                    ->columns(2),

                Section::make('SEO')
                    ->schema([
                        TextInput::make('seo_title')
                            ->maxLength(255)
                            ->placeholder('Page title for search engines'),
                        Textarea::make('seo_description')
                            ->rows(2)
                            ->maxLength(500)
                            ->placeholder('Meta description (max 500 chars)')
                            ->columnSpanFull(),
                    ])
                    ->columns(1),

                Section::make('Content')
                    ->schema([
                        Textarea::make('content')
                            ->rows(15)
                            ->columnSpanFull()
                            ->helperText('Main content. Aim for 1200-2000 words for SEO.'),
                    ]),

                Section::make('FAQs')
                    ->schema([
                        Repeater::make('faq_json')
                            ->schema([
                                TextInput::make('question')
                                    ->required()
                                    ->placeholder('Question'),
                                Textarea::make('answer')
                                    ->required()
                                    ->rows(3)
                                    ->placeholder('Answer'),
                            ])
                            ->columns(1)
                            ->itemLabel(fn (array $state): ?string => $state['question'] ?? null)
                            ->collapsible()
                            ->defaultItems(0),
                    ])
                    ->collapsed(),

                Section::make('Related Projects')
                    ->schema([
                        \Filament\Forms\Components\Select::make('projects')
                            ->label('Projects')
                            ->multiple()
                            ->relationship('projects', 'title')
                            ->preload()
                            ->searchable()
                            ->helperText('Select projects to display on this service landing page.'),
                    ])
                    ->collapsed(),
            ]);
    }
}
