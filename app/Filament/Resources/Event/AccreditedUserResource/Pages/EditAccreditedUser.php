<?php

namespace App\Filament\Resources\Event\AccreditedUserResource\Pages;

use App\Filament\Resources\Event\AccreditedUserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAccreditedUser extends EditRecord
{
    protected static string $resource = AccreditedUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
