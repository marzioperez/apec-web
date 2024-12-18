<?php

namespace App\Livewire\Auth;

use App\Concerns\Enums\Status;
use App\Concerns\Enums\Types;
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
            'status' => [
                Status::CONFIRMED->value,
                Status::PENDING_APPROVAL_DATA->value,
                Status::PENDING_CORRECT_DATA,
                Status::UNPAID->value,
                Status::PAYMENT_REVIEW->value,
                Status::SEND_TO_CHANCELLERY->value,
                Status::ERROR_IN_CHANCELLERY->value,
                Status::PENDING_ACCREDITATION->value,
                Status::OBSERVED_ACCREDITATION->value,
                Status::CANCEL_ACCREDITATION->value,
                Status::ACCREDITED->value,
            ]
        ], $this->remember_me)) {
            if (in_array(auth()->user()->type, [
                Types::STAFF->value,
                Types::COMPANION->value,
                Types::FREE_PASS_COMPANION->value,
                Types::FREE_PASS_STAFF->value
            ])) {
                $this->redirect(route('guest-progress'));
            } else {
                $this->redirect(route('progress'));
            }
        } else {
            $this->dispatch('open-modal', name: 'modal-status-error');
        }
    }

    public function render() {
        return view('livewire.auth.sign-in');
    }
}
