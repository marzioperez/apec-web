<?php

namespace App\Livewire\Common;

use App\Concerns\Enums\Status;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class QrReader extends Component {

    public $user = null;
    public $document_number;

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

    public function process_document_number() {
        if ($this->document_number) {
            $user = User::with('rel_economy')->where('document_number', $this->document_number)->first();
            sleep(1);
            if ($user) {
                $user->update(['status' => Status::ACCREDITED->value]);
                $this->user = $user;
                $this->dispatch('open-modal', id: 'user-data');
            }
        }
    }

    public function render() {
        return view('livewire.common.qr-reader')->layout('layouts.app', ['class' => 'bg-black']);
    }
}
