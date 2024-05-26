<?php

namespace App\Livewire\Common;

use App\Models\CategorySponsor;
use App\Models\Sponsor;
use Livewire\Attributes\On;
use Livewire\Component;

class Sponsors extends Component {

    public $data;
    public $categories;
    public $sponsor;


    public function mount($data) {
        $this->data = $data;
        $this->categories = CategorySponsor::with('sponsors')->ordered()->get();
    }

    #[On('show-sponsor')]
    public function show($sponsor) {
        $this->sponsor = $sponsor;
        $this->dispatch('open-modal', name: 'modal-sponsor');
    }

    public function render() {
        return view('livewire.common.sponsors');
    }
}
