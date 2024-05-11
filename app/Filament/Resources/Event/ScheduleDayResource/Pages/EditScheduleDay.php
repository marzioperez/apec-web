<?php

namespace App\Filament\Resources\Event\ScheduleDayResource\Pages;

use App\Filament\Resources\Event\ScheduleDayResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditScheduleDay extends EditRecord
{
    protected static string $resource = ScheduleDayResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
