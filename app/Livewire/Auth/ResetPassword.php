<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Livewire\Component;

class ResetPassword extends Component {

    public $email;

    protected $rules = [
        'email' => 'required|email'
    ];

    protected $messages = [
        '*.required' => 'Required field',
        '*.email' => 'Incorrect field'
    ];

    public function process(): void {
        $this->validate();
        $exists = User::where('email', $this->email)->first();

        if ($exists) {
            $new_password = Str::slug($exists->phone);
            $exists->update(['password' => $new_password]);
            Mail::to($this->email)->send(new \App\Mail\ResetPassword($exists, $new_password));
            // $this->toast('Your password has been successfully reset. Please check your email.');
            $this->dispatch('open-modal', name: 'modal-status-ok');
        } else {
            $this->dispatch('open-modal', name: 'modal-status-error');
        }
    }

    public function render() {
        return view('livewire.auth.reset-password');
    }
}
