<?php

namespace App\Livewire\User\Order;

use App\Concerns\Enums\Status;
use App\Models\Order;
use Livewire\Component;

class Index extends Component {

    public Order $order;
    public $current_step = 1;

    public function mount($token) {
        $order = Order::where('token', $token)->first();
        $user = auth()->user();
        if ($order) {
            if ($order['user_id'] === $user['id']) {
                if ($order['status'] === Status::UNPAID->value) {
                    $this->order = $order;
                    $this->current_step = $order['step'];
                } else {
                    $this->redirect(config('app.url'));
                }
            } else {
                $this->redirect(config('app.url'));
            }
        } else {
            $this->redirect(config('app.url'));
        }
    }

    public function render() {
        return view('livewire.user.order.index');
    }
}
