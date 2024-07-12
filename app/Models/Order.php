<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model {

    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'code',
        'token',
        'step',
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

        'payment_method',

        'payment_reference_name',
        'payment_reference_last_name',
        'payment_reference_phone',
        'payment_reference_email',
        'payment_voucher',

        'amount',
        'culqi_id',
        'status',
        'payment_date',
        'voucher_status',
        'voucher_comment'
    ];

    protected $casts = [
        'number' => 'integer',
        'accept_policy' => 'boolean',
        'amount' => 'decimal:2'
    ];

    public function user(): HasOne {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

}
