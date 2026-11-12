<?php

namespace App\Filament\Resources\Quotes\Pages;

use App\Filament\Resources\Quotes\QuoteResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Support\Facades\Storage;

class ViewQuote extends ViewRecord
{
    protected static string $resource = QuoteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\ActionGroup::make(
                $this->getRecord()->attachments->map(fn ($attachment) =>
                    Actions\Action::make('downloadAttachment' . $attachment->id)
                        ->label($attachment->original_name)
                        ->action(fn () => Storage::disk('quote_attachments')->download(
                            $attachment->file_path,
                            $attachment->original_name,
                            ['Cache-Control' => 'private, no-store'],
                        ))
                )->all(),
            )->label('Attachments')->button()->visible($this->getRecord()->attachments->isNotEmpty()),
        ];
    }
}

