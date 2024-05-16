<?php

namespace App\Livewire\User\Progress;

use App\Concerns\Enums\Status;
use App\Mail\CompleteRegister;
use App\Models\User;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;

class Step5 extends Component {

    public $badge_name, $badge_last_name, $badge_photo, $identity_document;
    public $cover;
    public User $user;

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
        $this->badge_name = $user['badge_name'] ?? $user['name'];
        $this->badge_last_name = $user['badge_last_name'] ?? $user['last_name'];


        $cover = asset('img/default-badge.png');
        if ($user['badge_photo']) {
            $cover = Storage::url($user['badge_photo']);
        }
        $this->cover = $cover;
    }

    public function process() {
        $this->validate();
        $this->user->update([
            'status' => Status::PENDING_APPROVAL_DATA->value,
            'register_progress' => 100,
            'badge_name' => $this->badge_name,
            'badge_last_name' => $this->badge_last_name
        ]);

        if ($this->badge_photo) {
            foreach ($this->badge_photo as $photo) {
                $put_photo = Storage::putFile('public/badges', new File($photo['path']));
                $set_photo = str_replace('public/', '', $put_photo);
                $this->user->update(['badge_photo' => $set_photo]);
            }
        }
        if ($this->identity_document) {
            foreach ($this->identity_document as $item) {
                $put_id = Storage::putFile('public/ids', new File($item['path']));
                $set_id = str_replace('public/', '', $put_id);
                $this->user->update(['identity_document' => 'ids/' . $set_id]);
            }
        }
        if ($this->user['status'] === Status::CONFIRMED) {
            Mail::to($this->user['email'])->send(new CompleteRegister());
        }
        $this->dispatch('update-progress', value: 100);
        $this->dispatch('open-modal', name: 'modal-status-ok');
    }

    #[On('update-photo')]
    public function updatePhoto($files) {
        $this->dispatch('set-cover', cover: $files[0]['temporaryUrl']);
    }

    public function render() {
        return view('livewire.user.progress.step5');
    }
}
