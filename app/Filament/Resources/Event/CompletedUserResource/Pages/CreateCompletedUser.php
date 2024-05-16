<?php

namespace App\Filament\Resources\Event\CompletedUserResource\Pages;

use App\Filament\Resources\Event\CompletedUserResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCompletedUser extends CreateRecord
{
    protected static string $resource = CompletedUserResource::class;
}
