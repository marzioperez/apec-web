<?php

namespace App\Filament\Resources\Event\CompletedUserResource\Pages;

use App\Actions\GenerateQrCode;
use App\Concerns\Enums\Status;
use App\Concerns\Enums\Types;
use App\Filament\Resources\Event\CompletedUserResource;
use App\Mail\CompleteDataFailed;
use App\Mail\CompleteDataPassFree;
use App\Mail\CompleteDataSuccess;
use App\Models\User;
use Filament\Actions;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Toggle;
use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Mail;

class EditCompletedUser extends EditRecord
{
    protected static string $resource = CompletedUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Action::make('Observar')
                ->icon('heroicon-o-eye')
                ->color('warning')
                ->label('Observar datos')
                ->modalHeading('Enviar observaciones')
                ->modalDescription('Esta acción regresará al usuario al estado de Confirmado para que ingrese con sus datos y corrija la información que se requiere subsanar. Si activas los campos de Limpiar foto o documento de identidad, estos datos se eliminarán del usuario para que vuelva a subir dicha información. Si se activa la opción para Habitar campos, dará paso a que el usuario pueda actualizar su información.')
                ->form([
                    RichEditor::make('observation')->label('Observaciones')->required()->columnSpanFull(),
                    Toggle::make('enable_photo')->label('Limpiar datos de foto')->columnSpanFull(),
                    Toggle::make('enable_id')->label('Limpiar datos de documento de identidad')->columnSpanFull(),
                    Toggle::make('enable_fields')->label('Habilitar campos')->columnSpanFull(),
                ])
                ->modalSubmitActionLabel('Aceptar')
                ->action(function (array $data, User $user):void {
                    if ($data['enable_photo']) {
                        $user->update(['badge_photo' => null]);
                    }
                    if ($data['enable_id']) {
                        $user->update(['identity_document' => null]);
                    }
                    $user->update([
                        'status' => Status::PENDING_CORRECT_DATA->value,
                        'observation' => $data['observation'],
                        'lock_fields' => !$data['enable_fields']
                    ]);
                    Mail::to($user['email'])->send(new CompleteDataFailed($user, $data['observation']));
                })->visible(fn(User $user): bool => $user['status'] === Status::PENDING_APPROVAL_DATA->value),
            Action::make('Confirmar')
                ->icon('heroicon-o-check-circle')
                ->color('success')
                ->label('Confirmar')
                ->requiresConfirmation()
                ->modalHeading('¿Confirmar registro?')
                ->modalDescription('Una vez que se confirme esta acción, el usuario recibirá su código QR de forma automática. Así como el envío de sus datos hacia Cancillería.')
                ->modalSubmitActionLabel('Confirmar')
                ->action(function (User $user):void {
                    if (in_array($user['type'], [
                        Types::PARTICIPANT->value,
                        Types::STAFF->value,
                        Types::COMPANION->value,
                        Types::VIP->value
                    ])) {
                        $user->update(['status' => Status::SEND_TO_CHANCELLERY->value]);
                        $qr = GenerateQrCode::run($user['code']);
                        $user->update([
                            'status' => Status::SEND_TO_CHANCELLERY->value,
                            'qr' => $qr
                        ]);
                        Mail::to($user['email'])->send(new CompleteDataSuccess($user));
                    }

                    if (in_array($user['type'], [
                        Types::FREE_PASS_PARTICIPANT->value,
                        Types::FREE_PASS_COMPANION->value,
                        Types::FREE_PASS_STAFF->value
                    ])) {
                        $qr = GenerateQrCode::run($user['code']);
                        $user->update([
                            'status' => Status::SEND_TO_CHANCELLERY->value,
                            'qr' => $qr
                        ]);
                        Mail::to($user['email'])->send(new CompleteDataPassFree($user));
                    }

                    // Todo: Implementar lógica para enviar datos a Cancillería
                    // SendUserToChancellery::run($user);
                })->visible(fn(User $user): bool => $user['status'] === Status::PENDING_APPROVAL_DATA->value),
        ];
    }
}
