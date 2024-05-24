<?php

namespace App\Filament\Resources\CMS\PageResource\Pages;

use App\Filament\Resources\CMS\PageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPage extends EditRecord {

    protected static string $resource = PageResource::class;

    protected function getHeaderActions(): array {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function afterSave(): void {
        if ($this->record['is_home']) {
            $this->record->update([
                'slug' => '/'
            ]);
        }
    }
}
