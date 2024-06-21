<?php

namespace App\Livewire\Report;

use App\Models\User;
use Livewire\Component;

class Users extends Component {

    public $fields = [];
    public $users = [];
    public $filters = [];
    public $columns = [];

    public function mount() {
        $this->fields = [
            ['title' => 'Título'],
            ['name' => 'Nombres'],
            ['last_name' => 'Apellido'],
            ['email' => 'Email'],
            ['gender' => 'Sexo'],
            ['document_type' => 'Tipo de document'],
            ['document_number' => 'Número de documento'],
            ['business' => 'Empresa'],
            ['economy' => 'Economía'],
            ['other_economy' => 'Otra economía'],
            ['business_description' => 'Descripción de la empresa'],
            ['business_email' => 'Email de la empresa'],
            ['role' => 'Cargo'],
            ['area' => 'Área'],
            ['address' => 'Dirección'],
            ['city' => 'Ciudad'],
            ['zip_code' => 'Código ZIP'],
            ['business_phone_number' => 'Teléfono empresa'],
            ['biography' => 'Biografía'],
            ['phone' => 'Celular'],

            ['date_of_issue' => 'Fecha de emisión'],
            ['place_of_issue' => 'Lugar de emisión'],
            ['date_of_birth' => 'Fecha de nacimiento'],
            ['nationality' => 'Nacionalidad'],
            ['city_of_permanent_residency' => 'Ciudad de residencia'],

            ['types_of_food' => 'Tipo de comida'],
            ['require_special_assistance' => 'Requiere asistencia especial'],
            ['special_assistance_details' => 'Detalle de asistencia especial'],
            ['food_allergies' => 'Alergias a los alimentos'],

            ['with_companion' => 'Lleva acompañante'],
            ['companion_free' => 'Acompañante gratis'],
            ['companion_amount' => 'Monto acompañante'],
            ['with_staff' => 'Lleva Staffer'],
            ['staff_free' => 'Staffer gratis'],
            ['staff_amount' => 'Monto Staffer'],

            ['blood_type' => 'Tipo de sangre'],
            ['allergies' => 'Alergias'],
            ['allergy_details' => 'Detalles de alergias'],
            ['vaccines' => 'Vacunas'],
//            'medical_others',
//            'medical_treatment',
//            'medical_treatment_details',
//            'taking_any_medication',
//            'chemical_name',
//            'brand_trade_name',
//            'dosis',
//            'frequency',
//
//            'dr_name',
//            'dr_last_name',
//            'dr_number',
//            'dr_email',
//
//            'insurance_company',
//            'insurance_id_number',
//            'insurance_phone',
//            'insurance_other_specifications',
//
//            'badge_name',
//            'badge_last_name',
//            'badge_photo',
//            'badge_extension',
//            'identity_document',
//            'identity_extension',
//
//            // Información de asistente (Opcional)
//            'attendee_name',
//            'attendee_email',
//            'send_copy_of_registration',
//            'accept_terms_and_conditions',
//
//            // QR
//            'qr',
//
//            'observation',
//            'amount',
//
//            'arrived_air_line',
//            'arrived_origin',
//            'arrived_flight_number',
//            'arrived_date',
//            'arrived_time',
//
//            'exit_air_line',
//            'exit_destination',
//            'exit_flight_number',
//            'exit_date',
//            'exit_time',
//
//            'flight_contact_number',
//            'flight_free_transportation',
//            'flight_details',
//            'flight_email_sent',
//            'flight_hotel_step',
//
//            'hotel_name',
//            'hotel_room',
//            'hotel_price',
//            'hotel_conditions_and_payment',
//            'hotel_check_in_date',
//            'hotel_check_in_hour',
//            'hotel_check_out_date',
//            'hotel_check_out_hour',
//            'hotel_details',
//
//            'chancellery_code',
        ];
    }

    public function process(): void {
        $this->users = User::select($this->filters)->get()->toArray();
        $columns = [];
        foreach ($this->fields as $field) {
            foreach ($field as $key => $value) {
                if (in_array($key, $this->filters)) {
                    $columns[] = $value;
                }
            }
        }
        $this->columns = $columns;
    }

    public function render() {
        return view('livewire.report.users');
    }
}
