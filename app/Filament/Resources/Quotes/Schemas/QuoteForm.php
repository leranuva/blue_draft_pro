<?php

namespace App\Filament\Resources\Quotes\Schemas;

use App\Models\Quote;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class QuoteForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('client_name')->required(),
                TextInput::make('email')->label('Email address')->email()->required(),
                TextInput::make('phone')->tel()->default(null),
                TextInput::make('address')->default(null),
                Select::make('borough')
                    ->options(Quote::getBoroughs())
                    ->placeholder('Inferred from address'),
                TextInput::make('service_type')->required(),
                Select::make('timeline')
                    ->options([
                        'asap' => 'ASAP',
                        '1-3 months' => '1–3 months',
                        '3-6 months' => '3–6 months',
                        '6+ months' => '6+ months',
                        'planning' => 'Just planning',
                    ])
                    ->placeholder('Not specified'),
                Select::make('property_type')
                    ->options([
                        'single_family' => 'Single family home',
                        'condo' => 'Condo',
                        'coop' => 'Co-op',
                        'multi_family' => 'Multi-family',
                        'commercial' => 'Commercial',
                    ])
                    ->placeholder('Not specified'),
                TextInput::make('estimated_budget')->default(null),
                TextInput::make('estimated_value')->label('Valor estimado ($)')->numeric()->minValue(0)->step(0.01),
                TextInput::make('internal_cost_estimate')->label('Costo interno ($)')->numeric()->minValue(0)->step(0.01),
                TextInput::make('expected_margin')->label('Margen esperado ($)')->numeric()->step(0.01),
                TextInput::make('closed_value')->label('Valor cerrado ($)')->numeric()->minValue(0)->step(0.01),
                TextInput::make('calculator_budget_min')->label('Calculator Budget Min'),
                TextInput::make('calculator_budget_max')->label('Calculator Budget Max'),
                TextInput::make('calculator_sqft')->label('Calculator Sq Ft')->numeric(),
                TextInput::make('calculator_type')->label('Calculator Type'),
                TextInput::make('calculator_borough')->label('Calculator Borough'),
                TextInput::make('calculator_finish_level')->label('Calculator Finish'),
                TextInput::make('calculator_algorithm_version')->label('Calculator Version'),
                TextInput::make('calculation_hash')->label('Calculation Hash'),
                Textarea::make('message')->default(null)->columnSpanFull(),
                Select::make('stage')
                    ->options(Quote::getStages())
                    ->default(Quote::STAGE_NEW)
                    ->required(),
                Select::make('status')
                    ->options(['pending' => 'Pending', 'contacted' => 'Contacted', 'completed' => 'Completed'])
                    ->default('pending')
                    ->required(),
                DateTimePicker::make('last_contacted_at')->label('Last Contacted'),
                Select::make('assigned_to')
                    ->label('Assigned To')
                    ->relationship('assignedTo', 'name')
                    ->searchable()
                    ->preload(),
                Toggle::make('is_partial')->label('Partial (Step 1 only)')->default(false),
                TextInput::make('step')->numeric()->minValue(1)->maxValue(2),
                TextInput::make('lead_score')->numeric()->minValue(0),
                DateTimePicker::make('abandoned_at'),
                TextInput::make('source_url')->label('Source URL (Referer)')->columnSpanFull()->url(),
                TextInput::make('lead_source')->label('Lead Source'),
                TextInput::make('utm_source')->label('UTM Source'),
                TextInput::make('utm_medium')->label('UTM Medium'),
                TextInput::make('utm_campaign')->label('UTM Campaign'),
                TextInput::make('utm_content')->label('UTM Content'),
                Textarea::make('user_agent')->rows(2)->columnSpanFull(),
                TextInput::make('ip_address'),
            ]);
    }
}
