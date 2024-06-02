<?php

namespace App\Livewire\User\Progress;

use App\Models\Economy;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class Step2 extends Component {

    public $data  = [
        'area' => null,
        'address' => null,
        'city' => null,
        'zip_code' => null,
        'phone' => null,
        'email' => null,
        'economy' => null,
        'other_economy' => null,
        'attendee_name' => null,
        'attendee_email' => null
    ];

    public User $user;
    public $quantity = 5, $current = 2, $complete = 1;
    public $economies = [];
    public $lock_fields = false;

    protected $messages = [
        'data.*.required' => 'Required field',
        'data.*.required_if' => 'Required field',
        'data.*.email' => 'Incorrect email format'
    ];

    protected $rules = [
        'data.area' => 'required',
        'data.address' => 'required',
        'data.city' => 'required',
        'data.zip_code' => 'required',
        'data.business_phone_number' => 'required',
        'data.business_email' => 'required|email',
        'data.economy' => 'required',
        'data.other_economy' => 'required_if:data.economy,other'
    ];

    public function mount(User $user, $quantity = 5, $current = 2, $complete = 1) {
        $this->user = $user;
        $this->lock_fields = $user['lock_fields'];
        $this->quantity = $quantity;
        $this->current = $current;
        $this->complete = $complete;
        $this->economies = Economy::all()->toArray();

        $this->data = [
            'area' => $user['area'],
            'address' => $user['address'],
            'city' => $user['city'],
            'zip_code' => $user['zip_code'],
            'business_phone_number' => $user['business_phone_number'],
            'business_email' => $user['business_email'],
            'economy' => $user['economy'],
            'other_economy' => $user['other_economy'],
            'attendee_name' => $user['attendee_name'],
            'attendee_email' => $user['attendee_email']
        ];
    }

    public function save() {
        $this->user->update($this->data);
        $this->toast('It has been saved. Your profile will be updated shortly.');
    }

    public function process() {
        $rules = [
            'area' => 'required',
            'address' => 'required',
            'city' => 'required',
            'zip_code' => 'required',
            'business_phone_number' => 'required',
            'business_email' => 'required|email',
            'economy' => 'required',
            'other_economy' => 'required_if:economy,other',
        ];

        $messages = [
            '*.required' => 'Required field',
            '*.required_if' => 'Required field',
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
