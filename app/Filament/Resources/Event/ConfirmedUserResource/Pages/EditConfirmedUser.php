<?php

namespace App\Filament\Resources\Event\ConfirmedUserResource\Pages;

use App\Filament\Resources\Event\ConfirmedUserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditConfirmedUser extends EditRecord
{
    protected static string $resource = ConfirmedUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
