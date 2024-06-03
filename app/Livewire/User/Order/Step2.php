<?php

namespace App\Livewire\User\Order;

use App\Actions\GenerateQrCode;
use App\Concerns\Enums\PaymentMethods;
use App\Concerns\Enums\Status;
use App\Mail\PaymentBankTransfer;
use App\Mail\PaymentSuccess;
use App\Models\Order;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\On;
use Livewire\Component;

class Step2 extends Component {

    public $data = [
        'payment_method' => null,
        'payment_reference_name' => null,
        'payment_reference_last_name' => null,
        'payment_reference_phone' => null,
        'payment_reference_email' => null,
        'payment_voucher' => null
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
            'payment_method' => $order['payment_method']
        ];
        $this->amount = $order['amount'];
    }

    public function process() {
        $rules = [];

        if ($this->data['payment_method'] === PaymentMethods::BANK_TRANSFER->value) {
            $rules = [
                'data.payment_reference_name' => 'required',
                'data.payment_reference_last_name' => 'required',
                'data.payment_reference_phone' => 'required',
                'data.payment_reference_email' => 'required',
                'data.payment_voucher' => 'required'
            ];

            $data_rules = [
                'payment_reference_name' => 'required',
                'payment_reference_last_name' => 'required',
                'payment_reference_phone' => 'required',
                'payment_reference_email' => 'required',
                'payment_voucher' => 'required'
            ];
        }

        $validator = Validator::make($this->data, $data_rules);

        if ($validator->fails()) {
            $this->toast('There are fields with errors', 'Errors', 'error');
        }

        if (count($rules) > 0) {
            $this->validate($rules);
        }
        $to_save = $this->data;
        $to_save['status'] = Status::PAYMENT_REVIEW->value;
        unset($to_save['payment_voucher']);
        $this->order->update($to_save);

        if ($this->data['payment_voucher']) {
            foreach ($this->data['payment_voucher'] as $file) {
                $put_file = Storage::putFile('public/vouchers', new File($file['path']));
                $set_file = str_replace('public/vouchers/', '', $put_file);
                $this->order->update(['payment_voucher' => $set_file]);
            }
        }

        $this->order->user->update([
            'status' => Status::PAYMENT_REVIEW->value,
            'lock_fields' => true
        ]);
        Mail::to($this->order->user['email'])->send(new PaymentBankTransfer($this->order->user));
        $this->dispatch('open-modal', name: 'modal-status-ok');
    }

    #[On('process-card-payment')]
    public function processCardPayment($data): void {
        if ($data['status'] === 'success') {
            $this->order->update([
                'status' => Status::PAID->value,
                'culqi_id' => $data['data']['id']
            ]);
            $this->order->user->update([
                'status' => Status::PENDING_APPROVAL_DATA->value,
                'lock_fields' => true
            ]);
            Mail::to($this->order->user['email'])->send(new PaymentSuccess($this->order->user));
            $this->dispatch('open-modal', name: 'modal-status-ok');
        } else {
            $this->dispatch('unloading');
            $this->dispatch('open-modal', name: 'modal-status-error');
        }
    }

    #[On('update-payment-method')]
    public function update_payment_method($method) {
        $this->data['payment_method'] = $method;
        $this->dispatch('toggle-payment-method', method: $method);
    }

    public function render() {
        return view('livewire.user.order.step2');
    }
}
