<?php

namespace App\Livewire\User\Order;

use App\Concerns\Enums\Types;
use App\Models\Order;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\On;
use Livewire\Component;

class Step1 extends Component {

    public $data = [
        'voucher_type' => null,
        'document_type' => null,
        'ruc' => null,
        'business_name' => null,
        'name' => null,
        'last_name' => null,
        'dni' => null,
        'client' => null,
        'document_id' => null,
        'physical_address' => null,
        'email_address' => null,
        'accept_policy' => null
    ];
    public $amount;
    public Order $order;

    protected $messages = [
        'data.*.required' => 'Required field',
        'data.*.email' => 'Incorrect email format',
        'data.*.accepted' => 'Accept this field',
    ];

    public function mount(Order $order) {
        $this->order = $order;
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
        $this->amount = $order['amount'];
    }

    public function change_voucher_type($type) {
        $this->data['voucher_type'] = $type;
    }

    public function process() {
        $rules = [
            'data.physical_address' => 'required',
            'data.email_address' => 'required',
            'data.accept_policy' => 'accepted'
        ];

        $data_rules = [
            'physical_address' => 'required',
            'email_address' => 'required',
            'accept_policy' => 'accepted'
        ];

        if ($this->data['voucher_type'] === Types::NATIONAL->value) {
            $data_rules = array_merge($data_rules, [
                'document_type' => 'required'
            ]);

            $rules = array_merge($rules, [
                'data.document_type' => 'required'
            ]);

            if ($this->data['document_type'] === Types::INVOICE->value) {
                $data_rules = array_merge($data_rules, [
                    'ruc' => 'required',
                    'business_name' => 'required'
                ]);

                $rules = array_merge($rules, [
                    'data.ruc' => 'required',
                    'data.business_name' => 'required'
                ]);
            }

            if ($this->data['document_type'] === Types::TICKET->value) {
                $data_rules = array_merge($data_rules, [
                    'name' => 'required',
                    'last_name' => 'required',
                    'dni' => 'required',
                ]);

                $rules = array_merge($rules, [
                    'data.name' => 'required',
                    'data.last_name' => 'required',
                    'data.dni' => 'required',
                ]);
            }
        }

        if ($this->data['voucher_type'] === Types::FOREIGNER->value) {
            $data_rules = array_merge($data_rules, [
                'client' => 'required',
                'id' => 'required'
            ]);

            $rules = array_merge($rules, [
                'data.client' => 'required',
                'data.id' => 'required'
            ]);
        }


        $validator = Validator::make($this->data, $data_rules);

        if ($validator->fails()) {
            $this->toast('There are fields with errors', 'Errors', 'error');
        }

        $this->validate($rules);

        $to_save = $this->data;
        $to_save['step'] = ($this->order['step'] > 2 ? $this->order['step'] : 2);
        $this->order->update($to_save);

        $this->dispatch('update-step', step: 2);
    }

    public function render() {
        return view('livewire.user.order.step1');
    }
}
