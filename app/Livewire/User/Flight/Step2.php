<?php

namespace App\Livewire\User\Flight;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class Step2 extends Component {

    public $data = [
        'hotel_name',
        'hotel_room',
        'hotel_price',
        'hotel_conditions_and_payment'
    ];

    public User $user;

    public function mount(User $user) {
        $this->user = $user;
        $this->data = [
            'hotel_name' => $user['hotel_name'],
            'hotel_room' => $user['hotel_room'],
            'hotel_price' => $user['hotel_price'],
            'hotel_conditions_and_payment' => $user['hotel_conditions_and_payment']
        ];
    }

    protected $messages = [
        'data.*.required' => 'Required field'
    ];

    public $rules = [
        'data.hotel_name' => 'required',
        'data.hotel_room' => 'required',
        'data.hotel_price' => 'required',
        'data.hotel_conditions_and_payment' => 'required'
    ];

    public function process() {
        $rules = [
            'hotel_name' => 'required',
            'hotel_room' => 'required',
            'hotel_price' => 'required',
            'hotel_conditions_and_payment' => 'required'
        ];

        $messages = [
            '*.required' => 'Required field'
        ];

        $validator = Validator::make($this->data, $rules, $messages);

        if ($validator->fails()) {
            $this->toast('There are fields with errors', 'Errors', 'error');
        }

        $this->validate($this->rules);

        $to_save = $this->data;
        $to_save['flight_email_sent'] = true;
        $this->user->update($to_save);
        $this->toast('It has been saved. Your profile will be updated shortly.');
    }

    public function render() {
        return view('livewire.user.flight.step2');
    }
}
