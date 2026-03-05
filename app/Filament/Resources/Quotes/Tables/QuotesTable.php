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
                TextColumn::make('estimated_value')
                    ->label('Est. Value')
                    ->money('USD')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('closed_value')
                    ->label('Closed Value')
                    ->money('USD')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('borough')
                    ->label('Borough')
                    ->badge()
                    ->formatStateUsing(fn (?string $state): string => $state ? (\App\Models\Quote::getBoroughs()[$state] ?? $state) : '—')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('lead_score')
                    ->label('Temp')
                    ->badge()
                    ->formatStateUsing(fn (int $state): string => $state . '/12 ' . (\App\Models\Quote::getScoreLabel($state)))
                    ->color(fn (int $state): string => \App\Models\Quote::getScoreColor($state))
                    ->sortable()
                    ->tooltip('Cold 0-4, Warm 5-8, Hot 9-12'),
                TextColumn::make('is_partial')
                    ->label('Partial')
                    ->badge()
                    ->color(fn (bool $state): string => $state ? 'warning' : 'gray')
                    ->formatStateUsing(fn (bool $state): string => $state ? 'Yes (Step 1)' : 'Complete')
                    ->sortable(),
                TextColumn::make('abandoned_at')
                    ->label('Abandoned')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('stage')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'new' => 'warning',
                        'contacted' => 'info',
                        'qualified' => 'info',
                        'proposal_sent' => 'primary',
                        'won' => 'success',
                        'lost' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => \App\Models\Quote::getStages()[$state] ?? $state)
                    ->sortable(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'contacted' => 'info',
                        'completed' => 'success',
                        default => 'gray',
                    })
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
                \Filament\Tables\Filters\SelectFilter::make('stage')
                    ->options(\App\Models\Quote::getStages()),
                \Filament\Tables\Filters\SelectFilter::make('borough')
                    ->options(\App\Models\Quote::getBoroughs()),
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
                \Filament\Tables\Filters\TernaryFilter::make('is_partial')
                    ->label('Partial leads (Step 1 only)')
                    ->placeholder('All')
                    ->trueLabel('Partial only')
                    ->falseLabel('Complete only'),
                \Filament\Tables\Filters\TernaryFilter::make('abandoned_at')
                    ->label('Abandoned')
                    ->placeholder('All')
                    ->trueLabel('Abandoned')
                    ->falseLabel('Not abandoned')
                    ->nullable(),
            ])
            ->defaultSort('lead_score', 'desc')
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
