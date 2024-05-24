<?php

namespace App\Filament\Resources\CMS\PageResource\Pages;

use App\Filament\Resources\CMS\PageResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePage extends CreateRecord {

    protected static string $resource = PageResource::class;

    protected function afterCreate(): void {
        if ($this->record['is_home']) {
            $this->record->update([
                'slug' => '/'
            ]);
        }
    }
}
