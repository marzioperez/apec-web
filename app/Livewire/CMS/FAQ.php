<?php

namespace App\Livewire\CMS;

use App\Models\FequentlyAskedQuestion;
use Livewire\Component;

class FAQ extends Component {

    public $faqs;

    public function mount() {
        $this->faqs = FequentlyAskedQuestion::ordered()->get();
    }

    public function render() {
        return view('livewire.cms.faq');
    }
}
