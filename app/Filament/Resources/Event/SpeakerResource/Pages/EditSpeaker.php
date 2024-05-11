<?php

namespace App\Filament\Resources\Event\SpeakerResource\Pages;

use App\Filament\Resources\Event\SpeakerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSpeaker extends EditRecord
{
    protected static string $resource = SpeakerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
