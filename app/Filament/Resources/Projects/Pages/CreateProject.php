<?php

namespace App\Filament\Resources\Projects\Pages;

use App\Filament\Resources\Projects\ProjectResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProject extends CreateRecord
{
    protected static string $resource = ProjectResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Asegurar que las rutas de imágenes se guarden correctamente
        if (isset($data['image_before']) && is_array($data['image_before'])) {
            $data['image_before'] = $data['image_before'][0] ?? null;
        }
        
        if (isset($data['image_after']) && is_array($data['image_after'])) {
            $data['image_after'] = $data['image_after'][0] ?? null;
        }

        return $data;
    }
}
