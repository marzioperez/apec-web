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
            Status::ERROR_IN_CHANCELLERY->value,
            Status::PENDING_ACCREDITATION->value,
            Status::OBSERVED_ACCREDITATION->value,
            Status::CANCEL_ACCREDITATION->value,
            Status::ACCREDITED->value,
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
