<?php

namespace App\Livewire\User\Progress;

use App\Models\User;
use Livewire\Component;

class Index extends Component {

    public $progress = 0;
    public $current_step = 0;
    public User $user;

    public function mount () {
        $this->user = auth()->user();
        $this->progress = auth()->user()->register_progress;
        $this->current_step = auth()->user()->current_step;
    }

    public function render() {
        return view('livewire.user.progress.index');
    }
}
