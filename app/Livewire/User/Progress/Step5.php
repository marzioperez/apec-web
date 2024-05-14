<?php

namespace App\Livewire\User\Progress;

use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class Step5 extends Component {

    use WithFileUploads;

    public $badge_name, $badge_last_name, $badge_photo, $identity_document;
    public User $user;


    public function mount(User $user) {
        $this->user = $user;
        $this->badge_name = $user['badge_name'];
        $this->badge_last_name = $user['badge_last_name'];
        $this->badge_photo = $user['badge_photo'];
        $this->identity_document = $user['identity_document'];
    }

    public function process() {
        dd($this->badge_photo[0]);
    }

    #[On('upload-photo')]
    public function uploadPhoto() {
        dd($this->badge_photo);
    }

    public function render() {
        return view('livewire.user.progress.step5');
    }
}
