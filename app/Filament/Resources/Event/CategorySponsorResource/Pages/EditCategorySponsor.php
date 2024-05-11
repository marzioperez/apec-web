<?php

namespace App\Filament\Resources\Event\CategorySponsorResource\Pages;

use App\Filament\Resources\Event\CategorySponsorResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCategorySponsor extends EditRecord
{
    protected static string $resource = CategorySponsorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
