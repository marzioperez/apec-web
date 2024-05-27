<?php

namespace App\Livewire\Common;

use App\Models\Hotel;
use Livewire\Attributes\On;
use Livewire\Component;

class Hotels extends Component {

    public $hotels;
    public $data;
    public $hotel = null;

    public function mount($data) {
        $this->data = $data;
        $this->hotels = Hotel::ordered()->get();
    }

    #[On('show-hotel')]
    public function show($hotel) {
        $this->hotel = $hotel;
        $this->dispatch('open-modal', name: 'modal-hotel');
    }

    public function render() {
        return view('livewire.common.hotels');
    }
}
