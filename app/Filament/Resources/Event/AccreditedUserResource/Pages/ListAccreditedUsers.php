<?php

namespace App\Filament\Resources\Event\AccreditedUserResource\Pages;

use App\Filament\Resources\Event\AccreditedUserResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAccreditedUsers extends ListRecords
{
    protected static string $resource = AccreditedUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
