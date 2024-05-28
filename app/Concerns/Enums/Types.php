<?php

namespace App\Concerns\Enums;

enum Types: string {

    case PARTICIPANT = 'Participante';
    case VIP = 'VIP';
    case COMPANION = 'Acompañante';
    case STAFF = 'Staff';
    case FREE_PASS_PARTICIPANT = 'Participante pase libre';
    case FREE_PASS_COMPANION = 'Acompañante pase libre';
    case FREE_PASS_STAFF = 'Staff pase libre';

    case DNI = 'National ID (Perú)';
    case PASSPORT = 'Passport';
    case CE = 'C.E';

    case NATIONAL = 'Nacional';
    case FOREIGNER = 'Extranjero';
    case INVOICE = 'Factura';
    case TICKET = 'Boleta';
    case NO_SELECT_PREFERRED = 'No select preferred';
    case CREDIT_CARD = 'Tarjeta';
    case BANK_TRANSFER = 'Transferencia';


}
