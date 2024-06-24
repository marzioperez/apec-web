<?php

namespace App\Livewire\Event\Reader;

use App\Concerns\Enums\Status;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class QrReader extends Component {

    #[On('process-qr')]
    public function process_qr($code) {
        $this->dispatch('close-modal', id: 'modal-qr');
        $user = User::with('rel_economy')->where('code', $code)->first();
        sleep(1);
        if ($user) {
            $user->update(['status' => Status::ACCREDITED->value]);
            $this->dispatch('set-user', user: $user);
        }
    }

    public function render() {
        return view('livewire.event.reader.qr-reader');
    }
}
