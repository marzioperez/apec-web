<?php

namespace App\Filament\Resources\Security\AdminResource\Pages;

use App\Filament\Resources\Security\AdminResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAdmin extends CreateRecord
{
    protected static string $resource = AdminResource::class;
}
