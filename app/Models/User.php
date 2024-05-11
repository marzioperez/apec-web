<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable {

    use HasFactory, Notifiable;
    protected $fillable = [
        'code',
        'status',
        'register_progress',
        'current_step',

        'name',
        'last_name',
        'business',
        'economy',
        'business_description',
        'role',
        'biography',
        'email',
        'password',
        'phone',

        // Información de participante (Opcional)
        'attendee_name',
        'attendee_email',
        'send_copy_of_registration',
        'accept_terms_and_conditions'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'send_copy_of_registration' => 'boolean',
        'accept_terms_and_conditions' => 'boolean'
    ];

    protected function casts(): array {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getFullNameAttribute() :string {
        return html_entity_decode(trim($this->name . ' ' . $this->last_name));
    }
}
