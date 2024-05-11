<?php

namespace App\Filament\Resources\Event\ConfirmedUserResource\Pages;

use App\Filament\Resources\Event\ConfirmedUserResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateConfirmedUser extends CreateRecord
{
    protected static string $resource = ConfirmedUserResource::class;
}
