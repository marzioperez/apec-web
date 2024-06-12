<?php

namespace App\Livewire\Common;

use App\Concerns\Enums\Status;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class QrReader extends Component {

    public $user = null;

    #[On('process-qr')]
    public function process_qr($code) {
        $user = User::with('rel_economy')->where('code', $code)->first();
        sleep(2);
        if ($user) {
            $user->update(['status' => Status::ACCREDITED->value]);
            $this->user = $user;
            $this->dispatch('open-modal', id: 'user-data');
        }
    }

    public function render() {
        return view('livewire.common.qr-reader')->layout('layouts.app', ['class' => 'bg-black']);
    }
}
