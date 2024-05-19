<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model {

    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'code',
        'token',
        'number',
        'voucher_type',
        'document_type',

        // Datos para Factura
        'ruc',
        'business_name',

        // Datos para Boleta
        'name',
        'last_name',
        'dni',

        // Datos para extranjero
        'client',
        'document_id',

        'physical_address',
        'email_address',
        'accept_policy',

        'amount',
        'status'
    ];

    protected $casts = [
        'number' => 'integer',
        'accept_policy' => 'boolean',
        'amount' => 'decimal'
    ];

}
