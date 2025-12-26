<?php

namespace App\Filament\Resources\Projects\Pages;

use App\Filament\Resources\Projects\ProjectResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditProject extends EditRecord
{
    protected static string $resource = ProjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Filament FileUpload devuelve un array cuando hay archivos nuevos
        // o un string cuando se mantiene el archivo existente
        if (isset($data['image_before'])) {
            if (is_array($data['image_before'])) {
                // Si es array, tomar el primer elemento (nuevo archivo)
                $data['image_before'] = !empty($data['image_before']) ? $data['image_before'][0] : null;
            }
            // Si es string, mantenerlo como está (archivo existente)
        }
        
        if (isset($data['image_after'])) {
            if (is_array($data['image_after'])) {
                // Si es array, tomar el primer elemento (nuevo archivo)
                $data['image_after'] = !empty($data['image_after']) ? $data['image_after'][0] : null;
            }
            // Si es string, mantenerlo como está (archivo existente)
        }

        return $data;
    }
}
