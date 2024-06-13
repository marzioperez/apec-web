<?php

namespace App\Livewire\User\Progress;

use App\Concerns\Enums\Types;
use App\Models\User;
use Livewire\Component;

class Index extends Component {

    public $progress = 0;
    public $current_step = 0;
    public User $user;

    public function mount () {
        $this->user = auth()->user();
        if (in_array($this->user['type'], [
            Types::STAFF->value,
            Types::STAFF_CP->value,
            Types::COMPANION->value,
            Types::FREE_PASS_COMPANION->value,
            Types::FREE_PASS_STAFF->value,
            Types::SECURITY->value,
            Types::PERSONAL_SECURITY->value,
            Types::SUPPLIER->value,
            Types::LIAISON->value,
            Types::EXHIBITOR->value
        ])) {
            $this->redirect(route('guest-progress'));
        }

        $this->progress = auth()->user()->register_progress;
        $this->current_step = auth()->user()->current_step;
    }

    public function render() {
        return view('livewire.user.progress.index');
    }
}
