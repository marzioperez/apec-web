<?php

namespace App\Livewire\User\Flight;

use App\Models\Hotel;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\On;
use Livewire\Component;

class Step2 extends Component {

    public $data = [
        'hotel_name',
        'hotel_room',
        'hotel_check_in_date',
        'hotel_check_in_hour',
        'hotel_check_out_date',
        'hotel_check_out_hour',
        'hotel_details'
    ];

    public User $user;
    public $hotels;
    public $hotel = null;

    public function mount(User $user) {
        $this->hotels = Hotel::ordered()->get();
        $this->user = $user;
        $this->data = [
            'hotel_name' => $user['hotel_name'],
            'hotel_room' => $user['hotel_room'],
            'hotel_check_in_date' => $user['hotel_check_in_date'],
            'hotel_check_in_hour' => $user['hotel_check_in_hour'],
            'hotel_check_out_date' => $user['hotel_check_out_date'],
            'hotel_check_out_hour' => $user['hotel_check_out_hour'],
            'hotel_details' => $user['hotel_details']
        ];
    }

    #[On('show-hotel')]
    public function show($hotel) {
        $this->hotel = $hotel;
        $this->dispatch('open-modal', name: 'modal-hotel');
    }

    protected $messages = [
        'data.*.required' => 'Required field'
    ];

    public $rules = [
        'data.hotel_name' => 'required',
        'data.hotel_room' => 'required',
        'data.hotel_check_in_date' => 'required',
        'data.hotel_check_in_hour' => 'required',
        'data.hotel_check_out_date' => 'required',
        'data.hotel_check_out_hour' => 'required',
    ];

    public function process() {
        $rules = [
            'hotel_name' => 'required',
            'hotel_room' => 'required',
            'hotel_check_in_date' => 'required',
            'hotel_check_in_hour' => 'required',
            'hotel_check_out_date' => 'required',
            'hotel_check_out_hour' => 'required'
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
        // $to_save['flight_email_sent'] = true;
        $this->user->update($to_save);
        $this->toast('It has been saved. Your profile will be updated shortly.');
    }

    public function back() {
        $this->dispatch('change-step', step: 1);
    }

    public function render() {
        return view('livewire.user.flight.step2');
    }
}
