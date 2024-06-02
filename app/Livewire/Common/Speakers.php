<?php

namespace App\Livewire\Common;

use App\Models\Speaker;
use Livewire\Component;

class Speakers extends Component {

    public $data;
    public $speakers = [];

    public function mount($data) {
        $this->data = $data;
        $speakers = Speaker::ordered()->get();
        $this->speakers = collect($speakers)->chunk(6);
    }

    public function render() {
        return view('livewire.common.speakers');
    }
}
