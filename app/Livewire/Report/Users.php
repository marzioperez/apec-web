<?php

namespace App\Livewire\Report;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Users extends Component {

    use WithPagination;

    public $fields = [];
    public $filters = [];
    public $columns = [];
    public $check_all = false;

    public function mount() {
        $this->fields = [
            ['label' => 'Fecha de registro', 'value' => 'created_at_format'],
            ['label' => 'Tipo de usuario', 'value' => 'type'],
            ['label' => 'Estado de usuario', 'value' => 'status'],
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

            ['label' => 'Tratamiento médico', 'value' => 'medical_treatment'],
            ['label' => 'Detalle tratamiento mécido', 'value' => 'medical_treatment_details'],
            ['label' => 'Otros datos médicos', 'value' => 'medical_others'],
            ['label' => 'Toma alguna medicación', 'value' => 'taking_any_medication'],
            ['label' => 'Nombre químico', 'value' => 'chemical_name'],
            ['label' => 'Nombre comercial', 'value' => 'brand_trade_name'],
            ['label' => 'Dosis', 'value' => 'dosis'],
            ['label' => 'Frecuencia', 'value' => 'frequency'],

            ['label' => 'Nombre del doctor', 'value' => 'dr_name'],
            ['label' => 'Apellido del doctor', 'value' => 'dr_last_name'],
            ['label' => 'Nro. del doctor', 'value' => 'dr_number'],
            ['label' => 'Email del doctor', 'value' => 'dr_email'],

            ['label' => 'Compañía de seguros', 'value' => 'insurance_company'],
            ['label' => 'ID de seguro', 'value' => 'insurance_id_number'],
            ['label' => 'Teléfono de seguro', 'value' => 'insurance_phone'],
            ['label' => 'Otras datos del seguro', 'value' => 'insurance_other_specifications'],

            ['label' => 'Nombre para Badge', 'value' => 'badge_name'],
            ['label' => 'Apellido para Badge', 'value' => 'badge_last_name'],

            ['label' => 'Nombre asistente', 'value' => 'attendee_name'],
            ['label' => 'Email asistente', 'value' => 'attendee_email'],

            ['label' => 'Monto a pagar', 'value' => 'amount'],

            ['label' => 'Llegada - Línea aérea',  'value' => 'arrived_air_line'],
            ['label' => 'Llegada - Origen',  'value' => 'arrived_origin'],
            ['label' => 'Llegada - Número de vuelo',  'value' => 'arrived_flight_number'],
            ['label' => 'Llegada - Fecha',  'value' => 'arrived_date'],
            ['label' => 'Llegada - Hora',  'value' => 'arrived_time'],

            ['label' => 'Salida - Línea aérea',  'value' => 'exit_air_line'],
            ['label' => 'Salida - Destino',  'value' => 'exit_destination'],
            ['label' => 'Salida - Número de vuelo',  'value' => 'exit_flight_number'],
            ['label' => 'Salida - Fecha',  'value' => 'exit_date'],
            ['label' => 'Salida - Hora',  'value' => 'exit_time'],

            ['label' => 'Vuelo - Número de contacto', 'value' => 'flight_contact_number'],
            ['label' => 'Vuelo - Requiere transporte gratuito', 'value' => 'flight_free_transportation_name'],
            ['label' => 'Vuelo - Detalles', 'value' => 'flight_details'],

            ['label' => 'Nombre de hotel', 'value' => 'hotel_name'],
            ['label' => 'Número de habitación', 'value' => 'hotel_room'],
            ['label' => 'Precio hotel', 'value' => 'hotel_price'],
            ['label' => 'Condiciones y pago de hotel', 'value' => 'hotel_conditions_and_payment'],
            ['label' => 'Fecha de Check in', 'value' => 'hotel_check_in_date'],
            ['label' => 'Hora de Check in', 'value' => 'hotel_check_in_hour'],
            ['label' => 'Fecha de Check out', 'value' => 'hotel_check_out_date'],
            ['label' => 'Hora de Check out', 'value' => 'hotel_check_out_hour'],
            ['label' => 'Detalle de hotel', 'value' => 'hotel_details'],

            ['label' => 'Código de cancillería', 'value' => 'chancellery_code'],
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
            }
            $this->columns = $columns;
        }
    }

    public function export() {
        return Excel::download(new \App\Exports\Users($this->columns, $this->filters), 'users.xlsx');
    }

    public function updatedCheckAll() {
        if ($this->check_all) {
            $filters = [];
            foreach ($this->fields as $field) {
                $filters[] = $field['value'];
            }
            $this->filters = $filters;
        } else {
            $this->filters = [];
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
