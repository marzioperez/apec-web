<?php

namespace App\Filament\Resources\Event\ScheduleCategoryResource\Pages;

use App\Filament\Resources\Event\ScheduleCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditScheduleCategory extends EditRecord
{
    protected static string $resource = ScheduleCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
