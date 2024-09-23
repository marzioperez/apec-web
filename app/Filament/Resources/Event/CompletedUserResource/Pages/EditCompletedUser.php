<?php

namespace App\Filament\Resources\Event\CompletedUserResource\Pages;

use App\Actions\GenerateQrCode;
use App\Concerns\Enums\Status;
use App\Concerns\Enums\Types;
use App\Filament\Resources\Event\CompletedUserResource;
use App\Mail\CompleteDataFailed;
use App\Mail\CompleteDataPassFree;
use App\Mail\CompleteDataSuccess;
use App\Mail\PaymentSuccess;
use App\Models\Order;
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
                    if ($data['enable_fields']) {
                        $user->update(['lock_fields' => false]);
                    }
                    $user->update([
                        'status' => Status::PENDING_CORRECT_DATA->value,
                        'observation' => $data['observation']
                    ]);
                    Mail::to($user['email'])->send(new CompleteDataFailed($user, $data['observation']));
                })->visible(fn(User $user): bool => $user['status'] === Status::PENDING_APPROVAL_DATA->value),
            Action::make('Habilitar campos')
                ->icon('heroicon-o-eye')
                ->color('warning')
                ->label('Habilitar campos')
                ->modalHeading('Habilitar campos')
                ->modalDescription('Si activas los campos de Limpiar foto o documento de identidad, estos datos se eliminarán del usuario para que vuelva a subir dicha información. Si se activa la opción para Habilitar campos, dará paso a que el usuario pueda actualizar su información.')
                ->form([
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
                    if ($data['enable_fields']) {
                        $user->update(['lock_fields' => false]);
                    }
                    $user->update(['status' => Status::PENDING_CORRECT_DATA->value]);
                }),
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

    /*protected function beforeSave(): void {
        $current_type = $this->record->type;
        $new_type = $this->data['type'];

        // Si el tipo de usuario actual es diferente al nuevo
        if ($current_type !== $new_type) {
            // Obtenemos los tipos de usuario que pagan
            $payment_types = [
                Types::PARTICIPANT->value,
                Types::VIP->value,
                Types::COMPANION->value,
                Types::STAFF->value
            ];

            // Obtenemos los tipos de usuario que NO pagan
            $no_payment_types = [
                Types::STAFF_CP->value,
                Types::FREE_PASS_PARTICIPANT->value,
                Types::FREE_PASS_COMPANION->value,
                Types::FREE_PASS_STAFF->value
            ];

            // Si el usuario tiene el tipo de Paga
            if (in_array($current_type, $payment_types)) {
                // Si el usuario va a pasar a un tipo de usuario que NO Paga
                if (in_array($new_type, $no_payment_types)) {
                    // Si su estado es Pendiente de pago
                    if (in_array($this->record->status, [
                        Status::UNPAID->value,
                        Status::PENDING_CORRECT_DATA->value,
                        Status::PENDING_APPROVAL_DATA->value
                    ])) {
                        // Eliminamos el pedido en caso exista
                        $order = Order::where('user_id', $this->record->id)->get()->first();
                        if ($order) {
                            $order->delete();
                        }
                        // Enviamos el mail respectivo cuando ese tipo de usuario finaliza el proceso
                        $user = User::find($this->record->id);
                        Mail::to($this->record->email)->send(new PaymentSuccess($user));
                        $user->update(['status' => Status::PENDING_APPROVAL_DATA->value]);
                    }
                }
            }

            // Si el usuario tiene el tipo de No paga
            if (in_array($current_type, $no_payment_types)) {
                // Si el usuario va a pasar a un tipo de usuario que Paga
                if (in_array($new_type, $payment_types)) {
                    // Si su estado es Pendiente de aprobación de datos
                    if (in_array($this->record->status, [
                        Status::PENDING_APPROVAL_DATA->value,
                        Status::PENDING_CORRECT_DATA->value
                    ])) {
                        // Creamos el pedido con el monto asignado al usuario
                        Order::create([
                            'user_id' => $this->record->id,
                            'token' => md5($this->record->code),
                            'amount' => $this->record->amount
                        ]);
                        $user = User::find($this->record->id);
                        $user->update(['status' => Status::UNPAID->value]);
                    }
                }
            }
        }
    }*/

    protected function afterSave(): void {
        $order = Order::where('user_id', $this->record->id)->get()->first();
        if ($order) {
            if ($order['status'] === Status::UNPAID->value) {
                $order->update(['amount' => $this->record->amount]);
            }
        }
    }
}
