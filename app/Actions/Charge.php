<?php

namespace App\Actions;

use Culqi\Culqi;
use Culqi\Error\CulqiException;
use Lorisleiva\Actions\Concerns\AsAction;
use Mockery\Exception;

class Charge {
    use AsAction;

    public function handle($token, $description, $amount) {
        $culqi = new Culqi(['api_key' => config('services.culqi.secret')]);
        try {
            $charge = $culqi->Charges->create([
                'amount' => $amount,
                'capture' => true,
                'currency_code' => 'USD',
                'description' => $description,
                'email' => auth()->user()->email,
                'source_id' => $token,
                "antifraud_details" => array(
                    "first_name" => auth()->user()->name,
                    "last_name" => auth()->user()->last_name,
                    "phone_number" => auth()->user()->phone,
                ),
            ]);
            if (is_object($charge)) {
                return ['status' => 'success', 'data' => $charge];
            }
            if (is_string($charge)) {
                return ['status' => 'error', 'data' => json_decode($charge)];
            }
        }
        catch (CulqiException $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }
}
