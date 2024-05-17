<?php

namespace App\Livewire\User\Progress;

use App\Concerns\Enums\Types;
use App\Models\User;
use Livewire\Component;

class Guest extends Component {

    public $progress = 0;
    public $current_step = 0;
    public User $user;

    public function mount () {
        $this->user = auth()->user();
        if (in_array($this->user['type'], [
            Types::PARTICIPANT->value,
            Types::VIP->value,
            Types::FREE_PASS_PARTICIPANT->value
        ])) {
            $this->redirect(route('progress'));
        }

        $this->progress = auth()->user()->register_progress;
        $this->current_step = auth()->user()->current_step;
    }

    public function render() {
        return view('livewire.user.progress.guest');
    }
}
