<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class Home extends Component {

    public $qr_code;

    #[On('make-qr-code')]
    public function makeQrCode($file) {
        $this->qr_code = $file;
    }

    public function render() {
        return view('livewire.home');
    }
}
