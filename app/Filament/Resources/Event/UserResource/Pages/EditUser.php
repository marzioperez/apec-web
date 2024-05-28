<?php

namespace App\Filament\Resources\Event\UserResource\Pages;

use App\Concerns\Enums\Status;
use App\Filament\Resources\Event\UserResource;
use App\Mail\RegisterDeclined;
use App\Mail\RegisterSuccess;
use App\Models\User;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Mail;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Action::make('confirm')
                ->icon('heroicon-o-check-circle')
                ->color('success')
                ->label('Confirmar')
                ->requiresConfirmation()
                ->modalHeading('¿Confirmar registro?')
                ->modalDescription('Una vez que se confirme el registro del usuario, se le enviará un mensaje de forma automática con sus datos de acceso. Por favor confirme esta acción.')
                ->modalSubmitActionLabel('Confirmar')
                ->action(function (User $user):void {
                    $user->update(['status' => Status::CONFIRMED->value]);
                    Mail::to($user['email'])->send(new RegisterSuccess($user));
                })->visible(fn(User $user): bool => $user['status'] === Status::PENDING_APPROVAL->value),
            Action::make('decline')
                ->icon('heroicon-o-x-circle')
                ->color('danger')
                ->label('Rechazar')
                ->requiresConfirmation()
                ->modalHeading('¿Rechazar registro?')
                ->modalDescription('Una vez que se rechace el registro del usuario, se le enviará un mensaje de forma automática agradeciendo su registro. Por favor confirme esta acción.')
                ->modalSubmitActionLabel('Rechazar')
                ->action(function (User $user):void {
                    $user->update(['status' => Status::DECLINED->value]);
                    Mail::to($user['email'])->send(new RegisterDeclined($user));
                })->visible(fn(User $user): bool => $user['status'] === Status::PENDING_APPROVAL->value),
        ];
    }
}
