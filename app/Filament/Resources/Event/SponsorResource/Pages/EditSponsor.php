<?php

namespace App\Filament\Resources\Event\SponsorResource\Pages;

use App\Filament\Resources\Event\SponsorResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSponsor extends EditRecord
{
    protected static string $resource = SponsorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
