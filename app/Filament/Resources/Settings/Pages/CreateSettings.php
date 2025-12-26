<?php

namespace App\Filament\Resources\Settings\Pages;

use App\Filament\Resources\Settings\SettingsResource;
use Filament\Resources\Pages\CreateRecord;

class CreateSettings extends CreateRecord
{
    protected static string $resource = SettingsResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Si es una imagen, procesar el array de Filament
        if (isset($data['type']) && $data['type'] === 'image' && isset($data['value']) && is_array($data['value'])) {
            $data['value'] = !empty($data['value']) ? $data['value'][0] : null;
        }

        return $data;
    }
}
