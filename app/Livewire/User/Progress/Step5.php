<?php

namespace App\Livewire\User\Progress;

use App\Concerns\Enums\Status;
use App\Concerns\Enums\Types;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;

class Step5 extends Component {

    public $badge_name, $badge_last_name, $badge_photo, $identity_document;
    public $badge_file, $identity_document_file;
    public $cover;
    public User $user;
    public $lock_fields = false;
    public $quantity = 5, $current = 5, $complete = 4;

    protected $messages = [
        '*.required' => 'Required field'
    ];

    protected $rules = [
        'badge_name' => 'required',
        'badge_last_name' => 'required',
        'badge_photo' => 'required',
        'identity_document' => 'required',
    ];

    public function mount(User $user) {
        $this->user = $user;
        $this->lock_fields = $user['lock_fields'];
        $this->badge_name = $user['badge_name'] ?? $user['name'];
        $this->badge_last_name = $user['badge_last_name'] ?? $user['last_name'];

        $this->badge_file = $user['badge_photo'] ? Storage::url('badges/' . $user['badge_photo']) : null;
        $this->identity_document_file = $user['identity_document'] ? Storage::url('ids/' . $user['identity_document']) : null;

        $cover = asset('img/default-badge.png');
        if ($user['badge_photo']) {
            $cover = Storage::url('badges/' . $user['badge_photo']);
        }
        $this->cover = $cover;
    }

    public function process() {
        if ($this->user['status'] === Status::CONFIRMED->value) {
            $this->validate();
        }
        $current_user_status = $this->user['status'];
        $this->user->update([
            'register_progress' => 100,
            'badge_name' => $this->badge_name,
            'badge_last_name' => $this->badge_last_name
        ]);
        if ($this->badge_photo) {
            foreach ($this->badge_photo as $photo) {
                $put_photo = Storage::putFile('public/badges', new File($photo['path']));
                $set_photo = str_replace('public/badges/', '', $put_photo);
                $this->user->update(['badge_photo' => $set_photo]);
            }
        }
        if ($this->identity_document) {
            foreach ($this->identity_document as $item) {
                $put_id = Storage::putFile('public/ids', new File($item['path']));
                $set_id = str_replace('public/ids/', '', $put_id);
                $this->user->update(['identity_document' => $set_id]);
            }
        }

        $show_modal = false;
        if (in_array($this->user['type'], [
            Types::FREE_PASS_STAFF->value,
            Types::FREE_PASS_COMPANION->value,
            Types::FREE_PASS_STAFF->value,
        ])) {
            $this->user->update(['status' => Status::PENDING_APPROVAL_DATA->value]);
            $show_modal = true;
        } else {
            if ($current_user_status === Status::CONFIRMED->value) {
                $this->user->update(['status' => Status::UNPAID->value]);
                $order = Order::create([
                    'user_id' => $this->user['id'],
                    'token' => md5($this->user['code']),
                    'amount' => $this->user['amount']
                ]);
                $this->redirect(route('payment', ['token' => $order['token']]));
            }

            if ($current_user_status === Status::UNPAID->value) {
                $order = Order::where('user_id', $this->user['id'])->first();
                if ($order) {
                    $this->redirect(route('payment', ['token' => $order['token']]));
                }
            }
        }

        if ($current_user_status === Status::PENDING_CORRECT_DATA->value) {
            $this->user->update(['status' => Status::PENDING_APPROVAL_DATA->value]);
            $show_modal = true;
        }
        $this->dispatch('update-progress', value: 100);

        if ($show_modal) {
            $this->dispatch('open-modal', name: 'modal-status-ok');
        }
    }

    #[On('update-photo')]
    public function updatePhoto($files, $emitter) {
        if ($emitter === 'cover') {
            $this->dispatch('set-cover', cover: $files[0]['temporaryUrl']);
        }
    }

    public function render() {
        return view('livewire.user.progress.step5');
    }
}
