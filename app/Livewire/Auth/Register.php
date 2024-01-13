<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Livewire\Component;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class Register extends Component {

    public $name, $email, $password;

    protected $rules = [
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required'
    ];

    protected $messages = [
        'name.required' => "Campo obligatorio",
        'email.required' => "Campo obligatorio",
        'email.email' => "Campo incorrecto",
        'email.unique' => "El correo ya existe",
        'password.required' => "Campo obligatorio"
    ];

    public function process() {
        $this->validate();
        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password
        ]);

        $file = "qr-codes/user-{$user->id}.png";
        QrCode::size(250)->format('png')->generate($user->id, "../public/qr-codes/user-{$user->id}.png");
        $this->dispatch('make-qr-code', $file);
    }

    public function render() {
        return view('livewire.auth.register');
    }
}
