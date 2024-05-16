<?php

namespace App\Livewire\Auth;

use App\Concerns\Enums\Status;
use Livewire\Component;

class SignIn extends Component {

    public $email, $password, $remember_me = false;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required',
    ];

    protected $messages = [
        '*.required' => 'Required field',
        '*.email' => 'Incorrect field'
    ];

    public function process(): void {
        $this->validate();
        if (auth()->attempt([
            'email' => $this->email,
            'password' => $this->password,
            'status' => [Status::CONFIRMED->value, Status::PENDING_APPROVAL_DATA]
        ], $this->remember_me)) {
            $this->redirect(route('progress'));
        } else {
            $this->dispatch('open-modal', name: 'modal-status-error');
        }
    }
    public function render() {
        return view('livewire.auth.sign-in');
    }
}
