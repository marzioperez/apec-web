<?php

namespace App\Livewire\Report;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use function PHPUnit\Framework\isFalse;

class Users extends Component {

    use WithPagination;

    public $fields = [];
    public $filters = [];
    public $columns = [];

    public function mount() {
        $this->fields = [
            ['label' => 'Título', 'value' => 'title_name'],
            ['label' => 'Nombres', 'value' => 'name'],
            ['label' => 'Apellido', 'value' => 'last_name'],
            ['label' => 'Email', 'value' => 'email'],
            ['label' => 'Sexo', 'value' => 'gender_name'],
            ['label' => 'Tipo de documento', 'value' => 'document_type_name'],
            ['label' => 'Número de documento', 'value' => 'document_number'],
            ['label' => 'Empresa', 'value' => 'business'],
            ['label' => 'Economía', 'value' => 'economy_name'],
            ['label' => 'Otra economía', 'value' => 'other_economy'],
            ['label' => 'Descripción de la empresa', 'value' => 'business_description'],
            ['label' => 'Email de la empresa', 'value' => 'business_email'],
            ['label' => 'Cargo', 'value' => 'role'],
            ['label' => 'Área', 'value' => 'area'],
            ['label' => 'Dirección', 'value' => 'address'],
            ['label' => 'Ciudad', 'value' => 'city'],
            ['label' => 'Código ZIP', 'value' => 'zip_code'],
            ['label' => 'Teléfono empresa', 'value' => 'business_phone_number'],
            ['label' => 'Biografía', 'value' => 'biography'],
            ['label' => 'Celular', 'value' => 'phone'],

            ['label' => 'Fecha de emisión', 'value' => 'date_of_issue'],
            ['label' => 'Lugar de emisión', 'value' => 'place_of_issue'],
            ['label' => 'Fecha de nacimiento', 'value' => 'date_of_birth'],
            ['label' => 'Nacionalidad', 'value' => 'nationality'],
            ['label' => 'Ciudad de residencia', 'value' => 'city_of_permanent_residency'],

            ['label' => 'Tipo de comida', 'value' => 'types_of_food'],
            ['label' => 'Requiere asistencia especial', 'value' => 'require_special_assistance'],
            ['label' => 'Detalle de asistencia especial', 'value' => 'special_assistance_details'],
            ['label' => 'Alergias a los alimentos', 'value' => 'food_allergies'],

            ['label' => 'Tipo de sangre', 'value' => 'blood_type'],
            ['label' => 'Alergias', 'value' => 'allergies_name'],
            ['label' => 'Detalles de alergias', 'value' => 'allergy_details'],
            ['label' => 'Vacunas', 'value' => 'vaccines'],

            'medical_others',
            'medical_treatment',
            'medical_treatment_details',
            'taking_any_medication',
            'chemical_name',
            'brand_trade_name',
            'dosis',
            'frequency',
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
        if (count($this->filters) > 0) {
            $columns = [];
            foreach ($this->filters as $filter) {
                foreach ($this->fields as $field) {
                    if ($field['value'] === $filter) {
                        $columns[] = $field;
                    }
                }
                $this->columns = $columns;
            }
        }
    }

    public function render() {
        $users = [];
        if (count($this->columns) > 0) {
            $columns = [];
            foreach ($this->filters as $filter) {
                foreach ($this->fields as $field) {
                    if ($field['value'] === $filter) {
                        $columns[] = $field;
                    }
                }
                $this->columns = $columns;
            }
            $model = User::query();
            $users = $model->paginate(10);
        }
        return view('livewire.report.users', ['users' => $users]);
    }
}
