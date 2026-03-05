<?php

namespace App\Filament\Resources\Projects\Pages;

use App\Filament\Resources\Projects\ProjectResource;
use App\Models\Project;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class ListProjects extends ListRecords
{
    protected static string $resource = ProjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    public function table(Table $table): Table
    {
        $table = parent::table($table);

        // Override recordUrl to use id instead of slug (avoids 500 when slug is null)
        return $table->recordUrl(function (Model $record, Table $t): ?string {
            if (! ProjectResource::canEdit($record)) {
                return null;
            }
            return $this->getResourceUrl('edit', ['record' => $record->getKey()]);
        });
    }
}
