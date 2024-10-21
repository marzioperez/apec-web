<?php

namespace App\Livewire\Event\Reader;

use App\Concerns\Enums\Status;
use App\Models\User;
use Filament\Notifications\Notification;
use Livewire\Attributes\On;
use Livewire\Component;

class SearchByDocument extends Component {

    public $document_number;

    #[On('clear-data')]
    public function clear_data():void {
        $this->document_number = null;
    }

    public function search_document() {
        if ($this->document_number) {
            $user = User::with('rel_economy')->where('document_number', $this->document_number)->first();
            sleep(1);
            if ($user) {
                $this->dispatch('set-user', user: $user);
            } else {
                $this->dispatch('set-error', message: "No existe información de algún participante con el número de documento: {$this->document_number}.");
            }
        }
    }

    public function render() {
        return view('livewire.event.reader.search-by-document');
    }
}
