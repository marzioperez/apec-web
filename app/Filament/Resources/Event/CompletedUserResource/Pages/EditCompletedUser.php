<?php

namespace App\Filament\Resources\Event\CompletedUserResource\Pages;

use App\Filament\Resources\Event\CompletedUserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCompletedUser extends EditRecord
{
    protected static string $resource = CompletedUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
