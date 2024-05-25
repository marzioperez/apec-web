<?php

namespace App\Livewire\Common;

use App\Models\Speaker;
use Livewire\Component;

class Speakers extends Component {

    public $data;
    public $speakers = [];
    public $speaker = [
        'photo' => null,
        'name' => null,
        'summary' => null,
        'biography' => null,
        'social_networks' => null,
        'company' => null,
    ];

    public function mount($data) {
        $this->data = $data;
        $speakers = Speaker::ordered()->get();
        $this->speakers = collect($speakers)->chunk(6);
    }

    public function show($id) {
        $this->speaker = Speaker::find($id);
        $this->dispatch('open-modal', name: 'modal-speaker');
    }

    public function render() {
        return view('livewire.common.speakers');
    }
}
