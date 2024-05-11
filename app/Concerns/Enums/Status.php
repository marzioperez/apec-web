<?php

namespace App\Concerns\Enums;

enum Status: string {

    case IN_PROGRESS = 'En progreso';
    case CONFIRMED = 'Confirmado';
    case DECLINED = 'Rechazado';
    case PENDING_APPROVAL = 'Pendiente de aprobación';


}
