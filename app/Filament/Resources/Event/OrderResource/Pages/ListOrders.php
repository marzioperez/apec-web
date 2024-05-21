<?php

namespace App\Filament\Resources\Event\OrderResource\Pages;

use App\Filament\Resources\Event\OrderResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOrders extends ListRecords
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array {
        return [];
    }
}
