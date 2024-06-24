<?php

namespace App\Livewire\Event\Reader;

use App\Concerns\Enums\Status;
use App\Models\User;
use Livewire\Component;

class SearchByDocument extends Component {

    public $document_number = "47804233";

    public function process_document_number() {
        if ($this->document_number) {
            $user = User::with('rel_economy')->where('document_number', $this->document_number)->first();
            sleep(1);
            if ($user) {
                $user->update(['status' => Status::ACCREDITED->value]);
                $this->dispatch('set-user', user: $user);
            }
        }
    }

    public function render() {
        return view('livewire.event.reader.search-by-document');
    }
}
