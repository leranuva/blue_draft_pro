<?php

namespace App\Filament\Resources\Posts\Pages;

use App\Filament\Resources\Posts\PostResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePost extends CreateRecord
{
    protected static string $resource = PostResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (isset($data['featured_image']) && is_array($data['featured_image'])) {
            $data['featured_image'] = $data['featured_image'][0] ?? null;
        }
        return $data;
    }
}
