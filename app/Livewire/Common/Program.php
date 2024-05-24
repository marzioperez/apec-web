<?php

namespace App\Livewire\Common;

use App\Models\ScheduleCategory;
use Livewire\Component;

class Program extends Component {

    public $data;
    public $categories = [];

    public function mount($data) {
        $this->categories = ScheduleCategory::with('days.activities')->ordered()->get();
        $this->data = $data;
    }

    public function render() {
        return view('livewire.common.program');
    }
}
