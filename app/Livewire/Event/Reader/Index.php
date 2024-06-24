<?php

namespace App\Livewire\Event\Reader;

use Livewire\Attributes\On;
use Livewire\Component;

class Index extends Component {

    public $user;
    public $error_message;

    #[On('set-user')]
    public function set_user($user) {
        $this->user = $user;
        $this->dispatch('open-modal', id: 'user-data');
    }

    #[On('set-error')]
    public function set_error($message) {
        $this->error_message = $message;
        $this->dispatch('open-modal', id: 'modal-error');
    }

    public function render() {
        return view('livewire.event.reader.index');
    }
}
