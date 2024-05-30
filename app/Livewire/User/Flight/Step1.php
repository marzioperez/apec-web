<?php

namespace App\Livewire\User\Flight;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class Step1 extends Component {

    public $data = [
        'arrived_air_line',
        'arrived_origin',
        'arrived_flight_number',
        'arrived_date',
        'arrived_time',

        'exit_air_line',
        'exit_destination',
        'exit_flight_number',
        'exit_date',
        'exit_time',

        'flight_contact_number',
        'flight_free_transportation',
        'flight_details',
        'flight_email_sent',
        'flight_hotel_step',
    ];

    public User $user;

    public function mount(User $user) {
        $this->user = $user;
        $this->data = [
            'arrived_air_line' => $user['arrived_air_line'],
            'arrived_origin' => $user['arrived_origin'],
            'arrived_flight_number' => $user['arrived_flight_number'],
            'arrived_date' => $user['arrived_date'],
            'arrived_time' => $user['arrived_time'],

            'exit_air_line' => $user['exit_air_line'],
            'exit_destination' => $user['exit_destination'],
            'exit_flight_number' => $user['exit_flight_number'],
            'exit_date' => $user['exit_date'],
            'exit_time' => $user['exit_time'],

            'flight_contact_number' => $user['flight_contact_number'],
            'flight_free_transportation' => ($user['flight_free_transportation'] ? 'yes' : 'no'),
            'flight_details' => $user['flight_details']
        ];
    }

    protected $messages = [
        'data.*.required' => 'Required field'
    ];

    public $rules = [
        'data.arrived_air_line' => 'required',
        'data.arrived_origin' => 'required',
        'data.arrived_flight_number' => 'required',
        'data.arrived_date' => 'required',
        'data.arrived_time' => 'required',

        'data.exit_air_line' => 'required',
        'data.exit_destination' => 'required',
        'data.exit_flight_number' => 'required',
        'data.exit_date' => 'required',
        'data.exit_time' => 'required',

        'data.flight_contact_number' => 'required'
    ];

    public function process() {
        $rules = [
            'arrived_air_line' => 'required',
            'arrived_origin' => 'required',
            'arrived_flight_number' => 'required',
            'arrived_date' => 'required',
            'arrived_time' => 'required',

            'exit_air_line' => 'required',
            'exit_destination' => 'required',
            'exit_flight_number' => 'required',
            'exit_date' => 'required',
            'exit_time' => 'required',

            'flight_contact_number' => 'required',
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
        $to_save['flight_free_transportation'] = $this->data['flight_free_transportation'] === 'yes';
        $to_save['flight_hotel_step'] = 2;
        $this->user->update($to_save);
        $this->dispatch('update-step', step: 2);
        $this->toast('It has been saved. Your profile will be updated shortly.');
    }

    public function render() {
        return view('livewire.user.flight.step1');
    }
}
