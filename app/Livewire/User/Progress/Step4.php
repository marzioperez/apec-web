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

    protected $messages = [
        '*.*.required' => 'Required field',
        '*.*.email' => 'Incorrect email format',
        '*.*.unique' => 'Email already exists',
    ];

    public function mount(User $user) {
        $this->user = $user;
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
        if ($process) {
            $rules = [
                'blood_type' => 'required'
            ];
            $this->validate($rules);
        }
        $this->user->update([
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
            $this->dispatch('update-progress', value: 80);
            $this->dispatch('update-step', step: 5);
        }
        else {
            $this->toast('It has been saved. Your profile will be updated shortly.');
        }
    }

    public function render() {
        return view('livewire.user.progress.step4');
    }
}
