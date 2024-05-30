<?php

namespace App\Livewire\User;

use App\Concerns\Enums\Status;
use App\Models\User;
use Livewire\Component;

class Qr extends Component {

    public User $user;

    public function mount() {
        $user = auth()->user();
        if (in_array($user['status'], [
            Status::FINISHED->value,
            Status::SEND_TO_CHANCELLERY->value
        ])) {
            $this->user = $user;
        } else {
            $this->redirect(config('app.url'));
        }
    }

    public function render() {
        return view('livewire.user.qr')->layout('layouts.app', ['class' => 'bg-black']);
    }
}
