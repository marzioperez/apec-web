<?php

namespace App\Filament\Resources\Event\ScheduleDayResource\Pages;

use App\Filament\Resources\Event\ScheduleDayResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListScheduleDays extends ListRecords
{
    protected static string $resource = ScheduleDayResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
