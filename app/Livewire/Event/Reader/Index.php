<?php

namespace App\Livewire\Event\Reader;

use App\Concerns\Enums\Status;
use App\Models\User;
use Filament\Notifications\Notification;
use Livewire\Attributes\On;
use Livewire\Component;

class Index extends Component {

    public User $user;
    public $error_message;

    #[On('set-user')]
    public function set_user(User $user):void {
        $this->user = $user;
        $this->dispatch('open-modal', id: 'user-data');
    }

    public function confirm_user():void {
        if ($this->user) {
            $this->user->update(['status' => Status::ACCREDITED->value]);
            Notification::make()->success()->body('El participante ha sido acreditado!')->send();
            $this->dispatch('close-modal', id: 'user-data');
            $this->dispatch('clear-data');
        }
    }

    #[On('set-error')]
    public function set_error($message):void {
        $this->error_message = $message;
        $this->dispatch('open-modal', id: 'modal-error');
    }

    public function render() {
        return view('livewire.event.reader.index');
    }
}
