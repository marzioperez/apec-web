<?php

namespace App\Livewire\Common;

use App\Actions\Charge;
use Livewire\Attributes\On;
use Livewire\Component;

class CulqiForm extends Component {

    public $amount;

    public function mount($amount) {
        $this->amount = $amount;
    }

    #[On('get-token')]
    public function get_token($token) {
        $description = "Payment - " . config('app.name');
        $charge = Charge::run($token, $description, round(($this->amount * 100)));
        $this->dispatch('process-card-payment', data:$charge);
    }

    public function render() {
        return view('livewire.common.culqi-form');
    }
}
