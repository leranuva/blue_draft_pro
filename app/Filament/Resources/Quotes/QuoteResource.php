<?php

namespace App\Filament\Resources\Quotes;

use App\Filament\Resources\Quotes\Pages\CreateQuote;
use App\Filament\Resources\Quotes\Pages\EditQuote;
use App\Filament\Resources\Quotes\Pages\ListQuotes;
use App\Filament\Resources\Quotes\Pages\ViewQuote;
use App\Filament\Resources\Quotes\Schemas\QuoteForm;
use App\Filament\Resources\Quotes\Tables\QuotesTable;
use App\Models\Quote;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class QuoteResource extends Resource
{
    protected static ?string $model = Quote::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedEnvelope;
    
    protected static ?string $navigationLabel = 'Quote Requests';
    
    protected static ?string $modelLabel = 'Quote Request';
    
    protected static ?string $pluralModelLabel = 'Quote Requests';
    
    public static function getNavigationGroup(): ?string
    {
        return 'Site Settings'; // Mover al grupo Site Settings
    }
    
    public static function getNavigationSort(): ?int
    {
        return 6; // Aparecer después de Testimonials Settings (que tiene orden 5)
    }

    public static function form(Schema $schema): Schema
    {
        return QuoteForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return QuotesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListQuotes::route('/'),
            'edit' => EditQuote::route('/{record}/edit'),
        ];
    }
    
    public static function canCreate(): bool
    {
        return false; // Don't create quotes from admin, only view incoming ones
    }
}
