<?php

namespace App\Livewire\Event\Reader;

use Livewire\Attributes\On;
use Livewire\Component;

class Index extends Component {

    public $user;

    #[On('set-user')]
    public function set_user($user) {
        $this->user = $user;
        $this->dispatch('open-modal', id: 'user-data');
    }

    public function render() {
        return view('livewire.event.reader.index');
    }
}
