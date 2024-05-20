<?php

namespace App\Livewire\User\Order;

use Livewire\Component;

class Index extends Component {

    public function mount($token) {
        dd($token);
    }

    public function render() {
        return view('livewire.user.order.index');
    }
}
