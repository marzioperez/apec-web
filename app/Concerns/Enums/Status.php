<?php

namespace App\Concerns\Enums;

enum Status: string {

    case IN_PROGRESS = 'En progreso';
    case CONFIRMED = 'Confirmado';
    case DECLINED = 'Rechazado';
    case PENDING_APPROVAL = 'Pendiente de aprobación';
    case PENDING_APPROVAL_DATA = 'Pendiente de aprobación de datos';
    case PENDING_CORRECT_DATA = 'Pendiente de corrección de datos';
    case UNPAID = 'Pendiente de pago';
    case PAID = 'Pagada';
    case PAYMENT_REVIEW = 'Revisión de pago';
    case SEND_TO_CHANCELLERY = 'Enviado a cancillería';
    case FINISHED = 'Finalizado';

}
