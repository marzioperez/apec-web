<?php

namespace App\Filament\Resources\Event\CompletedUserResource\Pages;

use App\Filament\Resources\Event\CompletedUserResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCompletedUsers extends ListRecords
{
    protected static string $resource = CompletedUserResource::class;

    protected function getHeaderActions(): array {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array {
        return [CompletedUserResource\Widgets\ChancelleryApiStatus::class];
    }
}
