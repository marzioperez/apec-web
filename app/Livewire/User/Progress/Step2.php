<?php

namespace App\Livewire\User\Progress;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class Step2 extends Component {

    public $data  = [
        'business' => null,
        'role' => null,
        'area' => null,
        'address' => null,
        'city' => null,
        'zip_code' => null,
        'phone' => null,
        'email' => null,
        'economy' => null,
        'attendee_name' => null,
        'attendee_email' => null
    ];

    public User $user;
    public $quantity = 5, $current = 2, $complete = 1;

    protected $messages = [
        'data.*.required' => 'Required field',
        'data.*.email' => 'Incorrect email format'
    ];

    protected $rules = [
        'data.business' => 'required',
        'data.role' => 'required',
        'data.area' => 'required',
        'data.address' => 'required',
        'data.city' => 'required',
        'data.zip_code' => 'required',
        'data.phone' => 'required',
        'data.email' => 'required|email',
        'data.economy' => 'required'
    ];

    public function mount(User $user, $quantity = 5, $current = 2, $complete = 1) {
        $this->user = $user;
        $this->quantity = $quantity;
        $this->current = $current;
        $this->complete = $complete;

        $this->data = [
            'business' => $user['business'],
            'role' => $user['role'],
            'area' => $user['area'],
            'address' => $user['address'],
            'city' => $user['city'],
            'zip_code' => $user['zip_code'],
            'phone' => $user['phone'],
            'email' => $user['email'],
            'economy' => $user['economy']
        ];
    }

    public function save() {
        $this->user->update($this->data);
        $this->toast('It has been saved. Your profile will be updated shortly.');
    }

    public function process() {
        $rules = [
            'business' => 'required',
            'role' => 'required',
            'area' => 'required',
            'address' => 'required',
            'city' => 'required',
            'zip_code' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'economy' => 'required'
        ];

        $messages = [
            '*.required' => 'Required field',
            '*.email' => 'Incorrect email format'
        ];

        $validator = Validator::make($this->data, $rules, $messages);

        if ($validator->fails()) {
            $this->toast('There are fields with errors', 'Errors', 'error');
        }

        $this->validate();

        $current_step = $this->user['current_step'];
        $result = 100 / $this->quantity;
        $progress = $this->user['register_progress'];
        if ($current_step == 2) {
            $progress = $progress + $result;
        }

        $to_save = $this->data;
        $to_save['register_progress'] = $progress;
        $to_save['current_step'] = ($this->user['current_step'] > 2 ? $current_step : $current_step + 1);

        $this->user->update($to_save);

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
