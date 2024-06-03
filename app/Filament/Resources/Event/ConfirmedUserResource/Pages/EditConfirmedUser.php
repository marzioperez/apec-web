<?php

namespace App\Filament\Resources\Event\ConfirmedUserResource\Pages;

use App\Concerns\Enums\Status;
use App\Filament\Resources\Event\ConfirmedUserResource;
use App\Models\Order;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditConfirmedUser extends EditRecord
{
    protected static string $resource = ConfirmedUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function afterSave(): void {
        $order = Order::where('user_id', $this->record->id)->get()->first();
        if ($order) {
            if ($order['status'] === Status::UNPAID->value) {
                $order->update(['amount' => $this->record->amount,]);
            }
        }
    }
}
