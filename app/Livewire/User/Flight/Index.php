<?php

namespace App\Livewire\User\Flight;

use App\Concerns\Enums\Status;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class Index extends Component {

    public User $user;
    public $current_step = 1;

    public function mount() {
        $user = auth()->user();
        if (in_array($user['status'], [
            Status::PENDING_APPROVAL_DATA->value,
            Status::UNPAID->value,
            Status::ERROR_IN_CHANCELLERY->value,
            Status::PENDING_ACCREDITATION->value,
            Status::OBSERVED_ACCREDITATION->value,
            Status::CANCEL_ACCREDITATION->value,
            Status::ACCREDITED->value,
            Status::SEND_TO_CHANCELLERY->value
        ])) {
            $this->user = $user;
            $this->current_step = $user['flight_hotel_step'];
        } else {
            $this->redirect(config('app.url'));
        }
    }

    #[On('change-step')]
    public function chage_step($step) {
        $this->dispatch('update-step', step: $step);
    }

    public function render() {
        return view('livewire.user.flight.index')->layout('layouts.app', ['class' => 'bg-black']);
    }
}
