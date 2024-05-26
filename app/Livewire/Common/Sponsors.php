<?php

namespace App\Livewire\Common;

use App\Models\CategorySponsor;
use Livewire\Component;

class Sponsors extends Component {

    public $data;
    public $categories;


    public function mount($data) {
        $this->data = $data;
        $this->categories = CategorySponsor::with('sponsors')->ordered()->get();
    }

    public function render() {
        return view('livewire.common.sponsors');
    }
}
