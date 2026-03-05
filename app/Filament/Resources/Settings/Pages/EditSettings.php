<?php

namespace App\Filament\Resources\Settings\Pages;

use App\Filament\Resources\Settings\SettingsResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditSettings extends EditRecord
{
    protected static string $resource = SettingsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Si es una imagen, procesar el array de Filament
        if (isset($data['type']) && $data['type'] === 'image' && isset($data['value'])) {
            if (is_array($data['value'])) {
                $data['value'] = !empty($data['value']) ? $data['value'][0] : null;
            }
            // Si es string, mantenerlo como está (imagen existente)
        }

        return $data;
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // If it's an image and has a value, ensure it displays correctly in FileUpload
        if (isset($data['type']) && $data['type'] === 'image' && isset($data['value']) && $data['value']) {
            // Filament FileUpload espera que las rutas sean relativas al disco
            if (is_string($data['value']) && str_starts_with($data['value'], 'storage/')) {
                $data['value'] = str_replace('storage/', '', $data['value']);
            }
        }

        return $data;
    }
}
