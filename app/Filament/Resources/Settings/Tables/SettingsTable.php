<?php

namespace App\Filament\Resources\Settings\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SettingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('key')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->label('Key'),
                ImageColumn::make('value')
                    ->label('Image')
                    ->disk('public')
                    ->circular()
                    ->height('50px')
                    ->width('50px')
                    ->visible(fn ($record) => $record && $record->type === 'image')
                    ->defaultImageUrl(null),
                TextColumn::make('value')
                    ->searchable()
                    ->limit(50)
                    ->label('Value')
                    ->visible(fn ($record) => !$record || $record->type !== 'image'),
                TextColumn::make('group')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'hero' => 'primary',
                        'contact' => 'success',
                        'social' => 'info',
                        'seo' => 'warning',
                        default => 'gray',
                    })
                    ->sortable()
                    ->label('Group'),
                TextColumn::make('type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'image' => 'success',
                        'textarea' => 'info',
                        'url' => 'warning',
                        'email' => 'primary',
                        default => 'gray',
                    })
                    ->sortable()
                    ->label('Type'),
                TextColumn::make('updated_at')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                \Filament\Tables\Filters\SelectFilter::make('group')
                    ->options([
                        'general' => 'General',
                        'hero' => 'Hero Section',
                        'contact' => 'Contact Information',
                        'social' => 'Social Media',
                        'seo' => 'SEO',
                    ]),
                \Filament\Tables\Filters\SelectFilter::make('type')
                    ->options([
                        'text' => 'Text',
                        'textarea' => 'Textarea',
                        'number' => 'Number',
                        'boolean' => 'Boolean',
                        'url' => 'URL',
                        'email' => 'Email',
                        'image' => 'Image',
                    ]),
            ])
            ->defaultSort('group', 'asc')
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
