<?php

namespace App\Livewire\User\Order;

use App\Models\Order;
use Livewire\Attributes\On;
use Livewire\Component;

class Step1 extends Component {

    public $data = [
        'voucher_type' => null,
        'document_type' => null,

        // Datos para Factura
        'ruc' => null,
        'business_name' => null,

        // Datos para Boleta
        'name' => null,
        'last_name' => null,
        'dni' => null,

        // Datos para extranjero
        'client' => null,
        'document_id' => null,

        'physical_address' => null,
        'email_address' => null,
        'accept_policy' => null
    ];

    public function mount(Order $order) {
        $this->data = [
            'voucher_type' => $order['voucher_type'],
            'document_type' => $order['document_type'],
            'ruc' => $order['ruc'],
            'business_name' => $order['business_name'],
            'name' => $order['name'],
            'last_name' => $order['last_name'],
            'dni' => $order['dni'],
            'client' => $order['client'],
            'document_id' => $order['document_id'],
            'physical_address' => $order['physical_address'],
            'email_address' => $order['email_address'],
            'accept_policy' => $order['accept_policy']
        ];
    }

    #[On('change-voucher-type')]
    public function change_voucher_type($type) {
        $this->data['voucher_type'] = $type;
    }

    public function render() {
        return view('livewire.user.order.step1');
    }
}
