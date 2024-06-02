<?php

namespace App\Filament\Resources\CMS\FequentlyAskedQuestionResource\Pages;

use App\Filament\Resources\CMS\FequentlyAskedQuestionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFequentlyAskedQuestions extends ListRecords
{
    protected static string $resource = FequentlyAskedQuestionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
