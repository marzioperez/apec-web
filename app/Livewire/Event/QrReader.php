<?php

namespace App\Livewire\Event;

use App\Concerns\Enums\Status;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class QrReader extends Component {

    public $process_user;
    #[On('process-qr')]
    public function processQr($id) {
        $user = User::find($id);
        if ($user) {
            $user->update(['status' => Status::CONFIRM->value]);
            $this->process_user = $user;
        }
    }

    public function render() {
        return view('livewire.event.qr-reader');
    }
}
