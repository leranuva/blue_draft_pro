<?php

namespace App\Filament\Resources\Quotes\Pages;

use App\Filament\Resources\Quotes\QuoteResource;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Storage;

class EditQuote extends EditRecord
{
    protected static string $resource = QuoteResource::class;

    protected function getHeaderActions(): array
    {
        $attachments = $this->getRecord()->attachments;

        return [
            ActionGroup::make(
                $attachments->map(fn ($attachment) =>
                    Action::make('downloadAttachment' . $attachment->id)
                        ->label($attachment->original_name)
                        ->action(fn () => Storage::disk('quote_attachments')->download(
                            $attachment->file_path,
                            $attachment->original_name,
                            ['Cache-Control' => 'private, no-store'],
                        ))
                )->all(),
            )->label('Attachments')->button()->visible($attachments->isNotEmpty()),
            DeleteAction::make(),
        ];
    }
}
