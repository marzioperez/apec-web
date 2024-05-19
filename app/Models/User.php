<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable {

    use HasFactory, Notifiable;
    protected $fillable = [
        'code',
        'type',

        'status',
        'register_progress',
        'current_step',

        'title',
        'name',
        'last_name',
        'gender',
        'document_type',
        'document_number',
        'business',
        'economy',
        'business_description',
        'business_email',
        'role',
        'area',
        'address',
        'city',
        'zip_code',
        'business_phone_number',
        'biography',
        'email',
        'password',
        'phone',

        'date_of_issue',
        'place_of_issue',
        'date_of_birth',
        'nationality',
        'city_of_permanent_residency',

        'types_of_food',
        'require_special_assistance',

        'with_companion',
        'with_staff',

        'blood_type',
        'allergies',
        'allergy_details',
        'vaccines',
        'medical_others',
        'medical_treatment',
        'medical_treatment_details',
        'taking_any_medication',
        'chemical_name',
        'brand_trade_name',
        'dosis',
        'frequency',

        'dr_name',
        'dr_last_name',
        'dr_number',
        'dr_email',

        'insurance_company',
        'insurance_id_number',
        'insurance_phone',
        'insurance_other_specifications',

        'badge_name',
        'badge_last_name',
        'badge_photo',
        'identity_document',

        // Información de asistente (Opcional)
        'attendee_name',
        'attendee_email',
        'send_copy_of_registration',
        'accept_terms_and_conditions',

        // QR
        'qr',

        'observation',
        'amount',

        'parent_id'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'send_copy_of_registration' => 'boolean',
            'accept_terms_and_conditions' => 'boolean',
            'with_companion' => 'boolean',
            'with_staff' => 'boolean',
            'vaccines' => 'json',
            'amount' => 'decimal:2'
        ];
    }

    public function getFullNameAttribute() :string {
        return html_entity_decode(trim($this->name . ' ' . $this->last_name));
    }

    public function parent(): HasOne {
        return $this->hasOne(User::class, 'id', 'parent_id');
    }

    public function guests(): HasMany {
        return $this->hasMany(User::class, 'parent_id', 'id');
    }
}
