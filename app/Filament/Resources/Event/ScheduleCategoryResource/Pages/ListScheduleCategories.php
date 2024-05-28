<?php

namespace App\Filament\Resources\Event\ScheduleCategoryResource\Pages;

use App\Filament\Resources\Event\ScheduleCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListScheduleCategories extends ListRecords
{
    protected static string $resource = ScheduleCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
