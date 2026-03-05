<?php

namespace App\Filament\Resources\Services\Pages;

use App\Filament\Resources\Services\ServiceResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditService extends EditRecord
{
    protected static string $resource = ServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data = $this->transformFaqData($data);
        return $data;
    }

    private function transformFaqData(array $data): array
    {
        if (isset($data['faq_json']) && is_array($data['faq_json'])) {
            $data['faq_json'] = array_values(array_filter($data['faq_json'], fn ($item) => !empty($item['question'] ?? '') && !empty($item['answer'] ?? '')));
        }
        return $data;
    }
}
