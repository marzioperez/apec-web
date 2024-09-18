<?php

namespace App\Livewire\Auth;

use App\Actions\GenerateCode;
use App\Mail\Register;
use App\Models\Economy;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Livewire\Component;

class SignUp extends Component {

    public $name, $last_name, $business, $economy, $business_description, $role, $biography, $email, $confirm_email, $phone_number, $other_economy;
    public $send_copy_of_registration = false, $accept_terms_and_conditions = false;

//     public $name = 'Marzio', $last_name = 'Perez', $business = 'Marzio SAC', $economy = 16, $business_description = 'Desarrollo de sistemas', $role = 'CE0', $biography = 'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto.', $email = 'marzioperez@gmail.com', $confirm_email = 'marzioperez@gmail.com', $phone_number = '981277116', $other_economy = '';
//     public $send_copy_of_registration = false, $accept_terms_and_conditions = true;

    public $attendee_name, $attendee_email;
    public $current_step = 1;
    public $complete_step = 0;
    public $economies = [];

    public function mount() {
        $this->economies = Economy::all()->toArray();
    }

    public function process_step_1 (): void {
        $messages = [
            '*.required' => 'Required field',
            '*.required_if' => 'Required field',
            '*.email' => 'Incorrect email format',
            '*.unique' => 'Email already exists',
            '*.same' => 'Confirm email do not match'
        ];

        $rules = [
            'name' => 'required',
            'last_name' => 'required',
            'business' => 'required',
            'economy' => 'required',
            'other_economy' => 'required_if:economy,other',
            'business_description' => 'required',
            'role' => 'required',
            'biography' => 'required',
            'phone_number' => 'required',
            'email' => 'required|email|unique:users,email',
            'confirm_email' => 'required|same:email'
        ];

        $this->validate($rules, $messages);
        $this->current_step = 2;
        $this->complete_step = 1;
    }

    public function process_step_2 (): void {
        $messages = [
            '*.accepted' => 'Accept terms and conditions',
            '*.required_if' => 'Required field',
            '*.email' => 'Incorrect email format'
        ];

        $rules = [
            'attendee_name' => 'required_if:send_copy_of_registration,true',
            'attendee_email' => [
                'required_if:send_copy_of_registration,true',
                Rule::when($this->send_copy_of_registration, ['email'])
            ],
            'accept_terms_and_conditions' => 'accepted'
        ];

        $this->validate($rules, $messages);

        $code = GenerateCode::run($this->name, $this->last_name);
        $user = User::create([
            'code' => $code,
            'name' => $this->name,
            'last_name' => $this->last_name,
            'business' => $this->business,
            'economy' => $this->economy,
            'other_economy' => $this->other_economy,
            'business_description' => $this->business_description,
            'role' => $this->role,
            'biography' => $this->biography,
            'phone' => $this->phone_number,
            'email' => $this->email,
            'password' => bcrypt($this->phone_number),
            'attendee_name' => $this->attendee_name,
            'attendee_email' => $this->attendee_email,
            'send_copy_of_registration' => $this->send_copy_of_registration,
            'accept_terms_and_conditions' => $this->accept_terms_and_conditions
        ]);
        Mail::to($this->email)->send(new Register($user));
        if ($this->send_copy_of_registration) {
            Mail::to($this->attendee_email)->send(new Register($user));
        }
        $this->reset();
        $this->dispatch('open-modal', name: 'modal-status-ok');
    }

    public function render() {
        return view('livewire.auth.sign-up');
    }
}
