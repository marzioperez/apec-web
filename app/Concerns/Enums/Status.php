<?php

namespace App\Concerns\Enums;

enum Status: string {

    case IN_PROGRESS = 'En progreso';
    case CONFIRMED = 'Confirmado';
    case DECLINED = 'Rechazado';
    case PENDING_APPROVAL = 'Pendiente de aprobación';
    case PENDING_APPROVAL_DATA = 'Pendiente de aprobación de datos';
    case UNPAID = 'Pendiente de pago';

}
