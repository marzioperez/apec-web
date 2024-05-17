<?php

namespace App\Livewire\User\Progress;

use App\Models\User;
use Livewire\Component;

class Step4 extends Component {

    public $blood_type, $allergies = 'no', $allergy_details, $vaccines = [], $medical_others;
    public $medical_treatment = 'no', $medical_treatment_details, $taking_any_medication;
    public $chemical_name, $brand_trade_name, $dosis, $frequency;
    public $insurance_company, $insurance_id_number, $insurance_phone, $insurance_other_specifications;
    public $dr_name, $dr_last_name, $dr_number, $dr_email;
    public User $user;
    public $quantity = 5, $current = 4, $complete = 3;

    protected $messages = [
        '*.*.required' => 'Required field',
        '*.*.email' => 'Incorrect email format',
        '*.*.unique' => 'Email already exists',
    ];

    public function mount(User $user, $quantity = 5, $current = 4, $complete = 3) {
        $this->user = $user;
        $this->quantity = $quantity;
        $this->current = $current;
        $this->complete = $complete;

        $this->blood_type = $user['blood_type'];
        $this->allergies = ($user['allergies'] ? 'yes' : 'no');
        $this->allergy_details = $user['allergy_details'];
        $this->vaccines = !$user['vaccines'] ? [] : $user['vaccines'];
        $this->medical_others = $user['medical_others'];
        $this->medical_treatment = ($user['medical_treatment'] ? 'yes' : 'no');
        $this->medical_treatment_details = $user['medical_treatment_details'];
        $this->taking_any_medication = $user['taking_any_medication'];

        $this->chemical_name = $user['chemical_name'];
        $this->brand_trade_name = $user['brand_trade_name'];
        $this->dosis = $user['dosis'];
        $this->frequency = $user['frequency'];

        $this->insurance_company = $user['insurance_company'];
        $this->insurance_id_number = $user['insurance_id_number'];
        $this->insurance_phone = $user['insurance_phone'];
        $this->insurance_other_specifications = $user['insurance_other_specifications'];

        $this->dr_name = $user['dr_name'];
        $this->dr_last_name = $user['dr_last_name'];
        $this->dr_number = $user['dr_number'];
        $this->dr_email = $user['dr_email'];
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
            $this->validate($rules);

            if ($current_step == $this->current) {
                $progress = $progress + $result;
                $step = $step + 1;
            }
        }

        $this->user->update([
            'register_progress' => $progress,
            'current_step' => $step,
            'blood_type' => $this->blood_type,
            'allergies' => $this->allergies === 'yes',
            'allergy_details' => $this->allergy_details,
            'vaccines' => $this->vaccines,
            'medical_others' => $this->medical_others,
            'medical_treatment' => $this->medical_treatment === 'yes',
            'medical_treatment_details' => $this->medical_treatment_details,
            'taking_any_medication' => $this->taking_any_medication,
            'chemical_name' => $this->chemical_name,
            'brand_trade_name' => $this->brand_trade_name,
            'dosis' => $this->dosis,
            'frequency' => $this->frequency,

            'dr_name' => $this->dr_name,
            'dr_last_name' => $this->dr_last_name,
            'dr_number' => $this->dr_number,
            'dr_email' => $this->dr_email,

            'insurance_company' => $this->insurance_company,
            'insurance_id_number' => $this->insurance_id_number,
            'insurance_phone' => $this->insurance_phone,
            'insurance_other_specifications' => $this->insurance_other_specifications
        ]);
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
