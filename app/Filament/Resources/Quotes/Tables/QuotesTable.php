<?php

namespace App\Filament\Resources\Quotes\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class QuotesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('client_name')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->copyable()
                    ->icon('heroicon-o-envelope'),
                TextColumn::make('phone')
                    ->searchable()
                    ->icon('heroicon-o-phone'),
                TextColumn::make('service_type')
                    ->searchable()
                    ->badge()
                    ->color('info'),
                TextColumn::make('estimated_budget')
                    ->searchable()
                    ->label('Budget'),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'contacted' => 'info',
                        'completed' => 'success',
                        default => 'gray',
                    })
                    ->sortable(),
                TextColumn::make('attachments_count')
                    ->counts('attachments')
                    ->label('Photos')
                    ->icon('heroicon-o-photo')
                    ->badge()
                    ->color('gray'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                \Filament\Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'contacted' => 'Contacted',
                        'completed' => 'Completed',
                    ]),
                \Filament\Tables\Filters\SelectFilter::make('service_type')
                    ->label('Service Type')
                    ->options([
                        'residential' => 'Residential',
                        'commercial' => 'Commercial',
                        'renovation' => 'Renovation',
                        'other' => 'Other',
                    ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->recordActions([
                \Filament\Actions\ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
