<?php

namespace App\Actions;

use App\Models\Order;
use Culqi\Culqi;
use Lorisleiva\Actions\Concerns\AsAction;

class Refund {

    use AsAction;

    public function handle(Order $order) {
        $body = array(
            "amount" => $order['amount'] * 100,
            "charge_id" => $order['culqi_id'],
            "reason" => "solicitud_comprador"
        );
        $culqi = new Culqi(['api_key' => config('services.culqi.secret')]);
        $refund = $culqi->Refunds->create(
            $body
        );
        return $refund;
    }
}
