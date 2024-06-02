<?php

namespace App\Livewire\CMS;

use App\Models\Speaker;
use Livewire\Attributes\On;
use Livewire\Component;

class Page extends Component {

    public $blocks = [];
    public \App\Models\Page $page;
    public $hotel = null;
    public $sponsor = null;
    public $speaker = null;

    public function mount($slug = '/') {
        $model = \App\Models\Page::where('slug', $slug)->get()->first();
        if ($model) {
            $this->page = $model;
            $this->blocks = $model['content'];
        } else {
            $this->redirect(config('app.url'));
        }
    }

    #[On('show-hotel')]
    public function show_hotel($hotel) {
        $this->hotel = $hotel;
        $this->dispatch('open-modal', name: 'modal-hotel');
    }

    #[On('show-sponsor')]
    public function show_sponsor($sponsor) {
        $this->sponsor = $sponsor;
        $this->dispatch('open-modal', name: 'modal-sponsor');
    }

    #[On('show-speaker')]
    public function show($speaker) {
        $this->speaker = $speaker;
        $this->dispatch('open-modal', name: 'modal-speaker');
    }

    public function render() {
        return view('livewire.cms.page')->layout('layouts.app', ['class' => 'bg-black']);
    }
}
