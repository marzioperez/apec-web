<?php

namespace App\Concerns\Enums;

enum PaymentMethods: string {

    case CREDIT_CARD = 'Tarjeta';
    case BANK_TRANSFER = 'Transferencia bancaria';

}
