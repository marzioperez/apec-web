<?php

namespace App\Filament\Resources\Event\UserResource\Pages;

use App\Filament\Resources\Event\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;
}
