<?php

namespace App\Filament\Resources\CMS\FequentlyAskedQuestionResource\Pages;

use App\Filament\Resources\CMS\FequentlyAskedQuestionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFequentlyAskedQuestion extends EditRecord
{
    protected static string $resource = FequentlyAskedQuestionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
