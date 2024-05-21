<?php

namespace App\Livewire\User\Progress;

use App\Concerns\Enums\Status;
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
            Types::COMPANION->value,
            Types::FREE_PASS_COMPANION->value
        ])) {
            $this->redirect(route('guest-progress'));
        }

        if (in_array($this->user['status'], [
            Status::UNPAID->value,
            Status::SEND_TO_CHANCELLERY->value,
            Status::PAYMENT_REVIEW->value,
            Status::PENDING_APPROVAL_DATA
        ])) {
            $this->redirect(config('app.url'));
        }

        $this->progress = auth()->user()->register_progress;
        $this->current_step = auth()->user()->current_step;
    }

    public function render() {
        return view('livewire.user.progress.index');
    }
}
