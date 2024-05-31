<?php

namespace App\Livewire\CMS;

use Livewire\Attributes\On;
use Livewire\Component;

class Page extends Component {

    public $blocks = [];
    public \App\Models\Page $page;
    public $hotel = null;

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
    public function show($hotel) {
        $this->hotel = $hotel;
        $this->dispatch('open-modal', name: 'modal-hotel');
    }

    public function render() {
        return view('livewire.cms.page')->layout('layouts.app', ['class' => 'bg-black']);
    }
}
