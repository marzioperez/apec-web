<?php

namespace App\Livewire\Common;

use Illuminate\Support\Collection;
use Livewire\Component;

class CategorySponsors extends Component {

    public $sponsors;
    public $id;

    public function mount($sponsors, $id) {
        $this->sponsors = $sponsors;
        $this->id = $id;
    }

    public function render() {
        return view('livewire.common.category-sponsors');
    }
}
