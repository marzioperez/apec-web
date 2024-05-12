<?php

namespace App\Livewire\User\Progress;

use Livewire\Component;

class Index extends Component {

    public $progress = 0;

    public function mount () {
        $this->progress = auth()->user()->register_progress;
    }

    public function render() {
        return view('livewire.user.progress.index');
    }
}
