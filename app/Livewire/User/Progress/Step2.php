<?php

namespace App\Livewire\User\Progress;

use App\Models\User;
use Livewire\Component;

class Step2 extends Component {

    public $business, $role, $area, $address, $city, $zip_code, $phone, $email, $economy;
    public $attendee_name, $attendee_email;
    public User $user;
    public $quantity = 5, $current = 2, $complete = 1;

    protected $messages = [
        '*.required' => 'Required field',
        '*.email' => 'Incorrect email format'
    ];

    public function mount(User $user, $quantity = 5, $current = 2, $complete = 1) {
        $this->user = $user;
        $this->quantity = $quantity;
        $this->current = $current;
        $this->complete = $complete;

        $this->business = $user['business'];
        $this->role = $user['role'];
        $this->area = $user['area'];
        $this->address = $user['address'];
        $this->city = $user['city'];
        $this->zip_code = $user['zip_code'];
        $this->phone = $user['business_phone_number'];
        $this->email = $user['business_email'];
        $this->economy = $user['economy'];

        $this->attendee_name = $user['attendee_name'];
        $this->attendee_email = $user['attendee_email'];
    }

    public function save() {
        $this->user->update([
            'business' => $this->business,
            'role' => $this->role,
            'area' => $this->area,
            'address' => $this->address,
            'city' => $this->city,
            'zip_code' => $this->zip_code,
            'business_phone_number' => $this->phone,
            'business_email' => $this->email,
            'economy' => $this->economy,
            'attendee_name' => $this->attendee_name,
            'attendee_email' => $this->attendee_email
        ]);
        $this->toast('It has been saved. Your profile will be updated shortly.');
    }

    public function process() {
        $rules = [
            'role' => 'required',
            'area' => 'required',
            'address' => 'required',
            'city' => 'required',
            'zip_code' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'economy' => 'required'
        ];
        $this->validate($rules, $this->messages);

        $current_step = $this->user['current_step'];
        $result = 100 / $this->quantity;
        $progress = $this->user['register_progress'];
        if ($current_step == 2) {
            $progress = $progress + $result;
        }

        $this->user->update([
            'register_progress' => $progress,
            'current_step' => ($this->user['current_step'] > 2 ? $current_step : $current_step + 1),
            'business' => $this->business,
            'role' => $this->role,
            'area' => $this->area,
            'address' => $this->address,
            'city' => $this->city,
            'zip_code' => $this->zip_code,
            'business_phone_number' => $this->phone,
            'business_email' => $this->email,
            'economy' => $this->economy,
            'attendee_name' => $this->attendee_name,
            'attendee_email' => $this->attendee_email
        ]);

        // Actualizamos la barra de progreso solo si el usuario se encuentra en el paso 2
        if ($current_step === 2) {
            $this->dispatch('update-progress', value: $progress);
        }
        $this->dispatch('update-step', step: $this->current + 1);
    }

    public function render() {
        return view('livewire.user.progress.step2');
    }
}
