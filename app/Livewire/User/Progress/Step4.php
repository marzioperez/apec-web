<?php

namespace App\Livewire\User\Progress;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class Step4 extends Component {

    public $data  = [
        'blood_type' => null,
        'allergies' => 'no',
        'allergy_details' => null,
        'vaccines' => [],
        'medical_others' => null,
        'medical_treatment' => 'no',
        'medical_treatment_details' => null,
        'taking_any_medication' => null,
        'chemical_name' => null,
        'brand_trade_name' => null,
        'dosis' => null,
        'frequency' => null,
        'insurance_company' => null,
        'insurance_id_number' => null,
        'insurance_phone' => null,
        'insurance_other_specifications' => null,
        'dr_name' => null,
        'dr_last_name' => null,
        'dr_number' => null,
        'dr_email' => null,
    ];

    public User $user;
    public $quantity = 5, $current = 4, $complete = 3;
    public $lock_fields = false;

    protected $messages = [
        'data.*.required' => 'Required field'
    ];

    protected $rules = [
        'data.blood_type' => 'required'
    ];

    public function mount(User $user, $quantity = 5, $current = 4, $complete = 3) {
        $this->user = $user;
        $this->lock_fields = $user['lock_fields'];
        $this->quantity = $quantity;
        $this->current = $current;
        $this->complete = $complete;

        $this->data = [
            'blood_type' => $user['blood_type'],
            'allergies' => ($user['allergies'] ? 'yes' : 'no'),
            'allergy_details' => $user['allergy_details'],
            'vaccines' => !$user['vaccines'] ? [] : $user['vaccines'],
            'medical_others' => $user['medical_others'],
            'medical_treatment' => ($user['medical_treatment'] ? 'yes' : 'no'),
            'medical_treatment_details' => $user['medical_treatment_details'],
            'taking_any_medication' => $user['taking_any_medication'],

            'chemical_name' => $user['chemical_name'],
            'brand_trade_name' => $user['brand_trade_name'],
            'dosis' => $user['dosis'],
            'frequency' => $user['frequency'],

            'insurance_company' => $user['insurance_company'],
            'insurance_id_number' => $user['insurance_id_number'],
            'insurance_phone' => $user['insurance_phone'],
            'insurance_other_specifications' => $user['insurance_other_specifications'],

            'dr_name' => $user['dr_name'],
            'dr_last_name' => $user['dr_last_name'],
            'dr_number' => $user['dr_number'],
            'dr_email' => $user['dr_email'],
        ];
    }

    public function save($process) {
        $current_step = $this->user['current_step'];

        $step = $this->user['current_step'];
        $result = 100 / $this->quantity;
        $progress = $this->user['register_progress'];
        if ($process) {
            $rules = [
                'blood_type' => 'required'
            ];

            $messages = [
                '*.required' => 'Required field'
            ];

            $validator = Validator::make($this->data, $rules, $messages);

            if ($validator->fails()) {
                $this->toast('There are fields with errors', 'Errors', 'error');
            }

            $this->validate();

            $step = $this->current + 1;
            if ($current_step === $this->current) {
                $progress = $progress + $result;
                $step = $current_step + 1;
            }
        }

        $to_save = $this->data;
        $to_save['register_progress'] = $progress;
        $to_save['current_step'] = $step;
        $to_save['allergies'] = $this->data['allergies'] === 'yes';
        $to_save['medical_treatment'] = $this->data['medical_treatment'] === 'yes';
        $this->user->update($to_save);
        if ($process) {
            // Actualizamos la barra de progreso solo si el usuario se encuentra en el paso 3
            if ($current_step === $this->current) {
                $this->dispatch('update-progress', value: $progress);
            }
            $this->dispatch('update-step', step: $step);
        }
        else {
            $this->toast('It has been saved. Your profile will be updated shortly.');
        }
    }

    public function render() {
        return view('livewire.user.progress.step4');
    }
}
