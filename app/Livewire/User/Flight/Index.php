<?php

namespace App\Livewire\User\Flight;

use App\Concerns\Enums\Status;
use App\Models\User;
use Livewire\Component;

class Index extends Component {

    public User $user;
    public $current_step = 1;

    public function mount() {
        $user = auth()->user();
        if (in_array($user['status'], [
            Status::FINISHED->value,
            Status::SEND_TO_CHANCELLERY->value
        ])) {
            $this->user = $user;
            $this->current_step = $user['flight_hotel_step'];
        } else {
            $this->redirect(config('app.url'));
        }
    }

    public function render() {
        return view('livewire.user.flight.index')->layout('layouts.app', ['class' => 'bg-black']);
    }
}
