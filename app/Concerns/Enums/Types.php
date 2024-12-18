<?php

namespace App\Concerns\Enums;

enum Types: string {

    case PARTICIPANT = 'Participante';
    case VIP = 'VIP';
    case COMPANION = 'Acompañante';
    case STAFF = 'Staffer';
    case STAFF_CP = 'Staff';
    case FREE_PASS_PARTICIPANT = 'Participante pase libre';
    case FREE_PASS_COMPANION = 'Acompañante pase libre';
    case FREE_PASS_STAFF = 'Staffer pase libre';

    case SUPPLIER = 'Proveedor';
    case PERSONAL_SECURITY = 'Personal de seguridad';
    case SECURITY = 'Seguridad';
    case LIAISON = 'Enlace';
    case EXHIBITOR = 'Expositor';

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

    case ANCHOR = 'Ancla';
    case URL = 'URL';
}
