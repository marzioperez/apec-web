<?php

namespace App\Concerns\Enums;

enum Status: string {
    case CONFIRM = 'Confirmado';
    case PENDING = 'Pendiente';
}
