<?php

namespace App\Filament\Resources\Event\OrderResource\Pages;

use App\Concerns\Enums\PaymentMethods;
use App\Concerns\Enums\Status;
use App\Filament\Resources\Event\OrderResource;
use App\Mail\PaymentSuccess;
use App\Models\Order;
use App\Models\User;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Mail;

class EditOrder extends EditRecord
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Action::make('Confirmar')
                ->icon('heroicon-o-check-circle')
                ->color('success')
                ->label('Confirmar')
                ->requiresConfirmation()
                ->modalHeading('¿Confirmar pago?')
                ->modalDescription('Una vez que se confirme esta acción, el usuario pasará al estado Pendiente de aprobación de datos.')
                ->modalSubmitActionLabel('Confirmar')
                ->action(function (Order $order):void {
                    $order->update(['status' => Status::PAID->value]);
                    $order->user->update(['status' => Status::PENDING_APPROVAL_DATA->value]);
                    Mail::to($order->user['email'])->send(new PaymentSuccess($order->user));
                })->visible(fn(Order $order): bool => $order['payment_method'] === PaymentMethods::BANK_TRANSFER->value),
        ];
    }
}
