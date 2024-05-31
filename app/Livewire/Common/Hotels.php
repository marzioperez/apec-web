<?php

namespace App\Livewire\Common;

use App\Models\Hotel;
use Livewire\Attributes\On;
use Livewire\Component;

class Hotels extends Component {

    public $hotels;
    public $data;

    public function mount($data) {
        $this->data = $data;
        $this->hotels = Hotel::ordered()->get();
    }

    public function render() {
        return view('livewire.common.hotels');
    }
}
